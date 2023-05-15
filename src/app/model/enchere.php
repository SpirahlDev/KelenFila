<?php  
require_once("../config/functions.php");

class enchere{
    protected $Categorie,$idVendeur,$dateEnchere,$dureEnchere; 

    public static function createEnchere(string $dateEnchere, $dureEnchere,int $idCategorie,int $idVendeur,string $nomVendor):int{
        $db=use_db(true);
        $dateEnchere=date_create($dateEnchere,new DateTimeZone('UTC'));
        $dateEnchere=date_format($dateEnchere,'Y-m-d H:i');
        $requet="CALL CREATE_ENCHERE(?,?,?,?,?,@idEnchere)"; 
        $objet=$db->prepare($requet); 

        $num=bin2hex(random_bytes(10));
        $nomVendor=explode(" ",$nomVendor);
        $nomVendor=array_slice($nomVendor,0,5);
        $nomVendor=implode($nomVendor);
        $numEnch='ENCH-'.$nomVendor.$idVendeur.$num;

        $objet->bindValue(1,$dateEnchere,PDO::PARAM_STR);
        $objet->bindValue(2,$dureEnchere,PDO::PARAM_STR);
        $objet->bindValue(3,$idCategorie,PDO::PARAM_INT);
        $objet->bindValue(4,$idVendeur,PDO::PARAM_INT);
        $objet->bindValue(5,$numEnch,PDO::PARAM_STR);


        $objet->execute();
        $result = $db->query("SELECT @idEnchere as idEnchere");
        if ($result != false) {
            $idEnchere = $result->fetch(PDO::FETCH_ASSOC);
            $idEnchere=$idEnchere['idEnchere'];
        } else {
            $idEnchere=null;
        }
        $db=use_db(false);
        return $idEnchere;
    }
   
}
?>