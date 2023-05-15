<?php 
namespace ChatApp;
session_start();
// require_once("../server/include_files/functions.php");
require __DIR__ . '/vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    private $idEnchere;
    protected $clients;
    private $idLot=0;
    private $cursor=2;
    private $adju=[];
    private $votes=0;
    private $votant;
    private $nbParticipant;
    protected $lastEnchere;
    public function __construct($idEnchere) { 
        $this->idEnchere=$idEnchere;
        $this->votant=new \SplObjectStorage;
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        $this->nbParticipant = count($this->clients);
        //***
        // $this->startEnchere();
        // $data=[
        //     "name"=>$_SESSION["designUser"],
        //     "id"=>$_SESSION["idUser"]
        // ];
        // $this->clients->attach($conn,$data); //***pour la fin


        echo "Nouvelle connexion! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        //La variable msg sera au format json quand envoyer par le client. Elle comportera deux champs, "prix" et "isVoted"
        $numRecv = count($this->clients) - 1;
        
        // $msg=json_decode($msg,true);***

        //verifie le champs vote associer à un client pour soit augmenter ou baiser le nombre de vote
        if(isset($msg['isVoted'])){
            $choice=(boolean)$msg['isVoted'];

            if($this->votant->contains(($from))){
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
        if($msg>$this->lastEnchere["prix"]){
            //renseignant des dernières informations sur l'encherisseur
            $this->lastEnchere["prix"]=$msg;
            $data=$this->clients->offsetGet($from); 
            $this->lastEnchere["fromId"]=$data["id"];
            //enregistrement de l'encherisseur parmi les 3 retenues
            $this->adju[$this->cursor]=$this->lastEnchere;
            $this->cursor=(($this->cursor-1)<0)?2:$this->cursor-1;

            echo sprintf('Le connecté %d a envoyé le message "%s" to %d aux autres %s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
    
            foreach ($this->clients as $client) {
                if ($from !== $client) {
                    // $message=array(
                    //     "msg"=>$msg,
                    //     "from"=>$client[data["name"]],
                    //     "idClient"=>$client[data["idUser]
                    // );
                    // $json=json_encode($message);
                    $client->send($msg);
                } 
            }

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
            $this->changer();
        }
    }
    public function changeLot(){
        $this->changer();
    }
    private function changer(){
        $requet="SELECT idLot,designLot,descriptionLot,estimatLot,numeroLot,image1 INNER JOIN enchere on lot.idEnchere=".$this->idEnchere." where isVendue=0";
        
    }
    public function startEnchere(){
        //Methode permettant de charger vers le client les differents lots de l'enchère
    }
}
?>