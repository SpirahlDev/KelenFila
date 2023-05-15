<?php  
require_once("../model/lot.php");
require_once("../config/functions.php");

function fetch_produit($q){
    if($q["quest"]=="fetch"){
        $nb=$q["nb"];
        $produit=json_response(lot::getLots($nb));
        http_response_code(200);
        echo $produit;
    }
    if($q["quest"]=="info"){
        $id=$q["id"];
        $produit=json_response(lot::getLot_info($id));
        http_response_code(200);
        echo $produit;
    } 
} 
function fetch_vendeur($q){
$id=$q["id"];
    // APPEL METHODE GETVENDEUR DE VENDEUR 
}
function getInRoom($q){
    $idEnchere=$q; 
    $db=use_db(true);
    control_entry($idEnchere);
    $requet="SELECT idEnchere from enchere where enchere.idEnchere=?";
    $obj=$db->prepare($requet);
    $obj->bindValue(1,$idEnchere,PDO::PARAM_INT);
    $verif=$obj->execute();
    $verif=$obj->fetch(PDO::FETCH_ASSOC);
    $db=use_db(false);
    if($verif){
        $cache=new Memcached();
        $cache->addServer('127.0.0.1', 11211);  // Adresse IP et port du serveur Memcached
        $tab=$cache->get("ENCH");
        foreach($tab as $ench){
            if(($ench["isStarted"])&&$ench["idEnchere"]==$verif){
                $port=$ench["port"];
                header("Location:../ENCHERE/room.php?idEnchere=$verif&via=$port");
                break;
            }
        }
    }
    else{
        header("Location:../../public/");
    }
    exit();
    // APPEL METHODE ENTRER DAND UNE ENCHERE 
}
function putRappel($q){
    $id_lot=$q["id"];
}
function check_categorie_ifexist($q){
    control_entry($q);
    $db=use_db(true);
    $requete="SELECT idCategorie,descriptCategorie,designCategorie from categorie where designCategorie=:cat";
    $object=$db->prepare($requete);
    $object->execute([":cat"=>$q]);
    $CategorieInfos=$object->fetch(PDO::FETCH_ASSOC);
    $db=use_db(false);
    return $CategorieInfos;
}
?>