<?php 
    session_start();
    require_once("../model/enchere.php");
    require_once("../model/lot.php");
    require_once("../model/userHandling.php");
    require_once("../model/vendeur.php");
    // $_SESSION["idUser"];
 class dashboard{
    protected $nb_enchere_now,
    $nb_paiement_reçu,
    $nb_enchere_T,
    $nb_lots_vente,
    $nb_lot_total,
    $revenue,
    $nb_ventes,
    $lot_pour_livraison,
    $lot_livree,
    $nb_lot_achete; 
    
    protected $DATE;
    
    function __construct($id){
        $db=use_db(true);
            $requet1="SELECT idEnchere,dateEnchere from enchere where idEnchere=:id";
            $requet2="SELECT count(*) from enchere where idEnchere=:id";
            $requet3="SELECT count(*) from lot,enchere on lot.idEnchere=enchere.idEnchere where idEnchere=:id";
            // $lot_pour_livr="SELECT "
            $nb_lot_acht="SELECT count(*) from adjudicataire where idUser_adju=:id";
            $this->DATE=date('d-m-Y H:i:s');
        $db=use_db(false);
    }
    public function getVendorStatut(){

    }
    
    public function setVendorStatut(){

    }
    public static function ajouterEnchere(array $data,$id){
       
        // VERIFICATION DE L'EXISTENCE DE LA CATEGORIE 
        $rq="SELECT idCategorie from categorie where idCategorie=?";
        $db=use_db(true);
        $stm=$db->prepare($rq); 
        $stm->bindValue(1,$data["categorie"],PDO::PARAM_STR);
        $stm->execute();
        $cat=$stm->fetch(PDO::FETCH_ASSOC);
        if($cat){
           $nomVendor=$_SESSION["designUser"];
           $id=enchere::createEnchere($data["dateEnchere"],$data["dureEnchere"],$cat["idCategorie"],$id,$nomVendor);
        //    echo print_r($data);
        //    unset($data["dateEnchere"],$data["dureEnchere"],$data["categorie"]);
           // INSERTION DES ELEMENTS TEXTUELLE ET GRAPHIQUE DES LOTS REÇU 
          
           $result=$id;
        }
        else{
            $result=false;
        }
        return $result;
        
    }
    public static function ajouterLot($data,$idEnchere,$designUser){
        $dir="FTP-server/lots/$designUser/";
        if(!file_exists($dir)){
            mkdir($dir,0777,true);
        }
        $i=0;
        $retour=1;
        foreach($_FILES as $file){
            if(file_check($file)||$i>0){
                $i++;
                $file["name"]='ENCH0'.$idEnchere.'-'.$data["designLot"].$i.'.'.pathinfo($file["name"],PATHINFO_EXTENSION);
                $filesName[]=$file["name"];
                if(!move_uploaded_file($file["tmp_name"],$dir.$filesName[$i-1])&& $i==0){
                    $alert="Erreur lors de l'ajout de ".$data["designLot"];
                    return $alert;
                }

            }
        }
        if($retour){
            $retour=lot::insertLot($data["designLot"],$data["prix"],$data["descriptionLot"],$data["etatLot"],$data["numeroLot"],$dir.$filesName[0],$dir.$filesName[1],
            $dir.$filesName[2],$dir.$filesName[3],$dir.$filesName[4],$idEnchere);
        }
        return $retour;
    }

 }
?>