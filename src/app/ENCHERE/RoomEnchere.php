<?php 
namespace EnchereApp;
session_start();
/** Travaillais sur la partie de stockage des adjudicataires **/
require_once("../config/functions.php");
require __DIR__ . '/vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
 
class Enchere implements MessageComponentInterface { 
    protected $lastEnchere=[]; //va permettre de retenir les dernière informations sur la dernière enchère, comme le prix, le nom et l'identifiant de l'encherisseur
    private $idEnchere; 
    protected $clients; //object permettant de stocker dans un tableaux les clients connecté ainsi que les informations sur eux
    private $cursor=0; 
    private $adju=[]; //variable permettant de stocker les informations sur l'adjudicataire
    private $votes=0; //variable stockant le nombre de vote "Faire passer ce lot"
    private $votant; //variable stockant le nombre de votant
    private $nbParticipant=0; 
    private $lot=[]; //variable stockant les informations sur un lot en cours d'enchère 
    private $timer60; //variable permettant de stocker un gestionnaire d'évènement dont la fonction callback permet d'executer la methode $this->changeLot()
    private $timeOnMsg;
    private $loop;
    private $dbCursor;
    private $dureeEnchere;
    private $enchereTimer;
    private $heureLancement;


    public function __construct($idEnchere=0) { 
        $this->votant=new \SplObjectStorage;
        $this->idEnchere=$idEnchere;
        $this->clients = new \SplObjectStorage;
        $this->loop=\React\EventLoop\Loop::get();
        $this->enchereTimer=$this->loop->addTimer(3600*$this->dureeEnchere,function(){
            $this->terminateEnchere();
        });
        $this->charger();
        $this->heureLancement=new \DateTime;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Stocke le nouveau connecté pour l'envoie futur de message
        // $this->clients->attach($conn);
        $this->nbParticipant = count($this->clients);
        $this->sendCurrentLot($conn);
        $data=[
            "name"=>$_SESSION["designUser"],
            "id"=>$_SESSION["idUser"]
        ]; 
        $this->clients->attach($conn,$data); 

        $lastMsgTime=null;
        if(is_object($this->timeOnMsg)){ //si $this->timeOnMsg est un object, cela voudrais dire que l'enchère a déja commencé(une enchère a déja été envoyé)...
            $now=new \DateTime();
            $lastMsgTime=$now->getTimestamp()-$this->timeOnMsg->getTimestamp();
        }
        $infoActual["connected"]=array(
            "nbParticipant"=>$this->nbParticipant,
            "lastMsgTime"=>($lastMsgTime!=null)?60:$lastMsgTime
        );
        $conn->send(json_encode($infoActual)); //...alors le temps restant pour que le nouveau connecté lui est envoyé"
        echo "Nouvelle connexion! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        //La variable msg sera au format json quand envoyée par le client. Elle pourrait stocker soit un champs "prix", soit un "isVoted"
        if(isset($this->timer60) && is_object($this->timer60)){
            $this->loop->cancelTimer($this->timer60);
        }
        $numRecv = count($this->clients) - 1;
        
        $msg=json_decode($msg,true);

        //verifie le champs vote associer à un client pour soit augmenter ou baiser le nombre de vote
        if(isset($msg['isVoted'])){
            $choice=(boolean)$msg['isVoted'];

            $isFromInVotantCollection = false;
            foreach ($this->votant as $votantFrom) {
                if ($votantFrom === $from) { // Vérifie si les propriétés de l'objet $from correspondent à celles de l'objet $votantFrom
                    $isFromInVotantCollection = true;
                    break;
                }
            }

            if($isFromInVotantCollection){ //verifie si le client avait déja voté 
                if($this->votant[$from]!=$choice){
                    $this->votant->offsetSet($from,$choice);
                    if($this->votant[$from]){
                        $this->votes+=1;
                    }
                    else
                    $this->votes-=1;
                }
            }
            else{
                $this->votant->attach($from,$choice);
                $this->votes+=1;
            }
            $this->changeLotByVote();
            
        }
        if(isset($msg["prix"]) && $msg["prix"]>$this->lastEnchere["prix"] && $msg["prix"]>$this->lot["estimatLot"] && is_numeric($msg["prix"])){
            //renseignemant des dernières informations sur l'encherisseur
            $this->lastEnchere["prix"]=$msg["prix"];
            $data=$this->clients->offsetGet($from); 
            $this->lastEnchere["fromId"]=$data["id"];

            //enregistrement de l'encherisseur parmi les 3 retenues
            $this->adju[$this->cursor]=array(
                "prix"=>$this->lastEnchere["prix"],
                "idUser"=>$this->lastEnchere["fromId"]
            );
            $this->cursor=($this->cursor==2)?0:$this->cursor+1;

            echo sprintf('Le connecté %d a envoyé le message "%s" to %d aux autres %s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
            
            //reinitialiser le temps à chaque envoie de message
            
            $this->timeOnMsg=date_create();
            $timeIfAdded=false;
            if($this->timeOnMsg->getTimestamp()-$this->heureLancement->getTimestamp()>$this->dureeEnchere*3600-120){
                $this->loop->cancelTimer($this->enchereTimer);
                $this->enchereTimer=$this->loop->addTimer(120,function(){
                    $this->terminateEnchere();
                });
                $timeIfAdded=true;
            }

            foreach ($this->clients as $client) {
                if ($from !== $client) {
                    $message["enchere"]=array(
                        "msg"=>$msg,
                        "from"=>$data["name"],
                        "nbVotant"=>$this->votes,
                        "nbParticipant"=>$this->nbParticipant,
                        "timeAdd"=>$timeIfAdded
                    );
                    $json=json_encode($message);
                    $client->send($json);
                } 
            }
            $this->timer60=$this->loop->addTimer(60,function(){
                $this->StoreAdjudicataire();
                $this->changeLot();
            });
        }
       
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        $this->nbParticipant = count($this->clients);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
    public function changeLotByVote(){
        if($this->nbParticipant==$this->votes){
            //changer le lot courant pour le suivant
            $this->fetchNextLot();
            $response["lot"]=$this->lot;
            $response=json_encode($response);
            $this->timeOnMsg=null; //reinitialisation de l'objet timeOnMsg
            foreach ($this->clients as $client) {
                $client->send($response);
            }
        }
    }
    public function changeLot(){
        $this->fetchNextLot();
        $response["lot"]=$this->lot;
        $response=json_encode($response);
        $this->timeOnMsg=null; //reinitialisation de l'objet timeOnMsg
        foreach ($this->clients as $client) {
            $client->send($response);
        }
    }
    private function charger(){
        //methode permettant de lire dans la base de donnée, et de recuperer les lots,qui seront ensuite fetcher un a un
        $db=use_db(true);
        $requet="SELECT idLot,designLot,descriptionLot,estimatLot,etatLot,numeroLot,image1,designCategorie,durerEnchere FROM lot INNER JOIN enchere on lot.idEnchere=".$this->idEnchere." INNER JOIN categorie on enchere.idCategorie=categorie.idCategorie where isEnded=0";
        $this->dbCursor=$db->query($requet,\PDO::FETCH_ASSOC);
        $this->lot=$this->dbCursor->fetch();
        if(!$this->lot){
            $db=use_db(false);
            $this->terminateEnchere();
        }
        else
        $this->dureeEnchere=$this->lot["durerEnchere"];
    }
    private function fetchNextLot(){
        $this->lot=$this->dbCursor->fetch();
    }
    private function terminateEnchere(){
        if(is_object($this->timer60) && isset($this->enchereTimer)){
            $this->loop->cancelTimer($this->timer60);
            $this->loop->cancelTimer($this->enchereTimer);
        }
        $message["endEnchere"]=array(
            "msg"=>"Enchere Terminée !"
        );
        $message=json_encode($message);
        foreach($this->clients as $client){
            $client->send($message);
        }
        die();
    }
    private function StoreAdjudicataire(){
        //connexion db
        try{
            $base=new \PDO("mysql:host=localhost:3306;dbname=KelenFIla;charset=utf8","root","",[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        }
        catch(\Exception $e){
            echo("Erreur :".$e->getMessage());
        }
        //

        $requet="INSERT INTO adjudicataire (idUser_adju,idLot_lot,prix,place_adju) VALUES(?,?,?,?)";
        $rq=$base->prepare($requet);

        //fonction de trie pour réordonner les adjudicataires
        function trierParPrix($tableau, $cle) {
            usort($tableau, function($a, $b) use($cle) {
                return $b[$cle] - $a[$cle];
            });
            return $tableau;
        }

        $adjuTrie = trierParPrix($this->adju, "prix");
        foreach($this->clients as $cli){
            $donne=$this->clients->offsetGet($cli);
            if($donne["idUser"]==$adjuTrie[0]["idUser"]){
                $victoireMsg=array(
                    "victoireMsg"=>"Le lot ".$this->lot["numeroLot"]." (".$this->lot["designLot"].") vous appartient !"
                );
                $cli->send(json_encode($victoireMsg));
                break;
            }
        }
        foreach($adjuTrie as $key=>$adjudicataire){
            $rq->bindValue(1,$adjudicataire["idUser"],\PDO::PARAM_STR);
            $rq->bindValue(2,$this->lot["idLot"],\PDO::PARAM_STR);
            $rq->bindValue(3,$adjudicataire["prix"],\PDO::PARAM_STR);
            $rq->bindValue(4,$key+1,\PDO::PARAM_INT);
            $rq->execute();
        }
        $base=null;
    }
  
    
    public function sendCurrentLot($Newclient){
        //Methode permettant de charger vers le nouveau client connecté, le lot en cours de vente
        $lot["lot"]=$this->lot;
        $Newclient->send(json_encode($lot)); 
    }
}
?>

