<?php session_start();
require_once("functions.php");
    $db=use_db(true);
    $req="SELECT idCategorie,designCategorie
    FROM categorie";
    $stm=$db->query($req);
    $categorie=$stm->fetchAll(PDO::FETCH_ASSOC);
    $db=use_db(false);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once("head.php") ?>
    <title>Accueil</title>
    <script src="script_frontend/jquery.js"></script>
    <link rel="stylesheet" href="style_index.css">
    <link rel="stylesheet" href="produit/KelenLots/lots.css">
    <link rel="stylesheet" href="general_style/general_style.css">
</head>
<body>
    <header>
       <?php require_once("nav-bar.php");?> 
       <div id="header">
            <div id="left-head">
                <p>
Bienvenue sur KelenFila, le site d'enchères en ligne de référence en Côte d'Ivoire. Art ancien et moderne, électronique, livres, automobiles, etc. Bénéficiez d'un service de qualité et de produits certifiés par des experts.</p>
                <p>Votre partenaire de confiance</p>
                <button>Découvrir <img src="" alt=""></button>
            </div>
            <div id="right-head"> 
                <div class="child-r">
                    <div class="box-presentation" id="first-pr">
                        <img src="assets/img/afrique-masque-baoule.png" alt="">
                    </div>
                    <div class="box-presentation" id="second-pr">
                        <img src="assets/img/bague.png" alt="">
                    </div>
                </div>
                <div class="child-r">
                    <div class="box-presentation" id="third-pr">
                        <img src="assets/img/gouro-antiquites.png" alt="">
                    </div>
                    <div class="box-presentation" id="fourth-pr">
                        <img src="assets/img/apple-watch.png" alt="">
                    </div>
                </div>

            </div>
       </div>
    </header>
    <section id="kelen">
        <div class="child-kelen">
            <p>

            </p>
        </div>
        <div class="child-kelen">
            <img src="assets/img/auction.png" alt="">
        </div>
    </section>
    
    <?php 
        require_once("bloc_lot.php");

    ?>

    <?php require_once("footer.php")?>
    <script src="script_frontend/general_script.js"></script>
</body>
</html>