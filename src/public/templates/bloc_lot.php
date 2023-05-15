<?php 
    require_once("functions.php");
    $db=use_db(true);
    $requete="SELECT lot.*, enchere.dateEnchere,enchere.idEnchere
    FROM lot
    INNER JOIN enchere
    ON lot.idEnchere = enchere.idEnchere
    ORDER BY dateAjout DESC";
    $stm=$db->query($requete);
    $lots=$stm->fetchAll(PDO::FETCH_ASSOC);
    $db=use_db(false);
?>

   <?php require_once("screenLot.php")?>