<?php
require_once("../config/functions.php");

class lot{
    protected $designLot,$descriptionLot,$etatLot,$estimationLot,
    $numeroLot,$image1,$image2,$image3,$image4,$image5,$image6,
    $isVendue,$PrixVendue;


    public static function insertLot($designLot,$estimationLot,$descriptionLot,$etatLot,
    $numeroLot,$image1,$image2="",$image3="",$image4="",$image5="",$idEnchere):bool{
        $db=use_db(true);
        $image6=" ";
        $requet="CALL INSERT_LOT(:designLot, :descriptionLot, :etatLot, :estimationLot, :numeroLot, :image1, :image2, :image3, :image4, :image5, :image6,:idEnchere)";
        $objet = $db->prepare($requet);

        // Bind des paramètres
        $objet->bindParam(":designLot", $designLot);
        $objet->bindParam(":descriptionLot", $descriptionLot);
        $objet->bindParam(":etatLot", $etatLot);
        $objet->bindParam(":estimationLot", $estimationLot);
        $objet->bindParam(":numeroLot", $numeroLot); 
        $objet->bindParam(":image1", $image1);
        $objet->bindParam(":image2", $image2);
        $objet->bindParam(":image3", $image3);
        $objet->bindParam(":image4", $image4);
        $objet->bindParam(":image5", $image5);
        $objet->bindParam(":image6", $image6);
        $objet->bindParam(":idEnchere",$idEnchere);
    
        // Exécution de la requête
        $resultat=$objet->execute();
        $db=use_db(false);
        return $resultat;
    }

    public static function getLot_info(int $id){
        $requet="CALL BRING_LOT(?)";
        $db=use_db(true);
        $objet=$db->prepare($requet);
        $objet->bindValue(1,$id,PDO::PARAM_INT);
        $objet->execute();
        $resultat=$objet->fetch(PDO::FETCH_ASSOC);
        $db=use_db(false);
        return $resultat;
    }
    public static function getLots($maxi,$offset=0){
        control_entry($offset,$maxi);
        $db=use_db(true);
        $requet="SELECT designLot,estimatLot,numeroLot,image1 from lot order by dateAjout DESC LIMIT :offs,:maxi";
        $objet=$db->prepare($requet);
        $objet->bindValue(":maxi",$maxi,PDO::PARAM_INT);
        $objet->bindValue("offs",$offset,PDO::PARAM_INT);
        $objet->execute();
        $resultat=$objet->fetchAll(PDO::FETCH_ASSOC);
        
        $db=use_db(false);
        return $resultat;
    }
   
}

?>