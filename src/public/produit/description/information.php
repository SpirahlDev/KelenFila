<?php session_start();
require_once("root.php");
require_once("functions.php");
$idLot=$_GET["idLot"];
$db=use_db(true);
$requete="SELECT lot.*, enchere.dateEnchere,enchere.idEnchere,categorie.designCategorie
FROM lot
INNER JOIN enchere
ON lot.idEnchere = enchere.idEnchere
INNER JOIN categorie ON categorie.idCategorie=enchere.idCategorie
WHERE lot.idLot=?";

$stm=$db->prepare($requete);
$stm->bindValue(1,$idLot,PDO::PARAM_INT);
$stm->execute();
$lot=$stm->fetch(PDO::FETCH_ASSOC);
$db=use_db(false);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php 
    require_once("head.php") ?>
    <title>Description</title>
    <link rel="stylesheet" href="../lot-info.css">
    <script src="../script-lot.js"></script>
    <script src="../../script/jquery.js"></script> 
</head>
<body>  
    <header>
       <?php require_once("nav-bar.php")?>
        <article id="lot">
            <div class="div_under_lot" id="bloc-image-description">
                <div id="bloc-image-part">
                    <div id="cadre">
                        <div class="image-unite">
                            <img src="<?=ROOT_PROJECT.$lot["image1"]?>" alt="montre">
                        </div>
                        <div class="image-unite">
                            <img src="/opt/lampp/htdocs/KelenFila/image_prod/buggatti_57.png" alt="montre">
                        </div>
                        <div class="image-unite">
                            <img src="/opt/lampp/htdocs/KelenFila/image_prod/buggatti_57.png" alt="montre">
                        </div>
                        <div class="image-unite">
                            <img src="/opt/lampp/htdocs/KelenFila/image_prod/buggatti_57.png" alt="montre">
                        </div>
                        <div class="image-unite">
                            <img src="/opt/lampp/htdocs/KelenFila/image_prod/buggatti_57.png" alt="montre">
                        </div>
                    </div>
                </div>
                <ul id="position-img-unite">
                    <li class="position-unite" id="position1"></li>
                    <li class="position-unite" id="position2"></li>
                    <li class="position-unite" id="position3"></li>
                    <li class="position-unite" id="position4"></li>
                    <li class="position-unite" id="position5"></li>
                    <li id="cursor"></li>
                </ul>
                <div id="arrows">
                    <button id="left">left</button>
                    <button id="right">right</button>
                </div>
                <p class="rigth-span-etat">
                    enchere en cours
                </p>
                <form action="#" method="post" id="action-btn-lot">
                    <input type="hidden" value="" name="idLot">
                    <button class="input-btn">
                        <span>Participer</span>
                        <span>
                            <!-- <img src="#" alt="arrow"> -->
                        </span>
                    </button>
                </form>
            </div>
            <div class="div_under_lot" id="bloc-lot-description">
                <div class="a-propos">

                </div>
                <ul id="description-element">
                    <li><?=$lot["designCategorie"]?></li>
                    <li><?=$lot["designLot"]?></li>
                    <li>
                        <span>Esatimation</span>
                        <span><?=$lot["estimatLot"]?> <span #id="price">FCFA</span></span>
                    </li>
                    <li>
                        <p>Historique</p>
                        <p>
                           <?= $lot["descriptionLot"]?>
                        </p>
                    </li>
                    <li>
                        <span #id="etat-lot">
                           <?=$lot["etatLot"]?>
                        </span>
                        <span>
                            Vendeur
                        </span>
                        <span>
                            Jean François
                        </span>
                    </li>
                    <li id="info-divers">
                        <span>Lot <?=$lot["numeroLot"]?> du cataglogue</span>
                        <span><?=$lot["designCategorie"]?></span>
                    </li>
                </ul>
            </div>
        </article>
        <script src="../script-lot.js"></script>
    </header>



    <?php require_once("footer.php")?>
</body>
</html>