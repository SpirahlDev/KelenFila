<?php 
require_once("root.php");
$for_nav_path=ROOT_PROJECT.'src/public/';
?>
<nav class="nav-set"> 
        <a href="<?=$for_nav_path?>">
            <img src="<?=$for_nav_path?>assets/logo/kelenFila.png" id="logo" alt="kelenFila" title="Votre partenaire de confiance">
        </a>          
    <ul id="list-nav">
        <li><a href="<?=$for_nav_path?>">Accueil</a></li>
        <li id="acheter-nav-btn">
            <span>Acheter</span>
            <div id="menu-acheter-btn">
                <div class="column-menu"> 
                    <ul class="liste-menu">
                        <li class="head-menu-list"> <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Ameublement">Ameublement</a>  
                            <p>Mobilier</p>
                            <p>Tapis Et Tentures</p>
                        </li>
                        <li class="head-menu-list"> 
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Art et decoration">Art et decoration</a> 
                            <p>Objets d'Art</p>
                            <p>Art Ivoirien et Africain</p>
                            <p>Photographie</p>
                            <p>Tableaux</p>
                        </li>
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Arts de la table">Arts de la table</a>
                        </li>
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Horlogerie">Horlogerie</a> 
                        </li>
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Jouets">Jouets</a> 
                        </li>
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Livres">Livres</a> 
                        </li>
                    </ul>
                </div>
                <div class="column-menu"> 
                    <ul class="liste-menu">
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Mode %26 Bijoux">Mode Et bijoux</a> 
                        </li>
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Musique">Musique</a> 

                        </li>
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Vins %26 spiritueux">Vins et spiritueux</a> 
                        </li>
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Collections">Collections</a> 
                        </li>
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Divers">Divers</a> 
                        </li>
                    </ul>
                </div>
                <div class="column-menu">
                    <ul class="liste-menu">
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Informatique %26 Telephonie">Informatique et Téléphonie</a> 
                        </li>
                        <li class="head-menu-list">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Électroménager %26 Matériel professionnel">Electroménager & Matériel professionnel</a> 
                        </li>
                        <li class="head-menu-list" id="vehicule">
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=">Véhicules</a></li>
                        <li>
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Voitures de sport et de collection">Voitures de sport et de Collection</a> 
                        </li>
                        <li>
                            <a href="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php?header=categorie-search&search=Autres véhicules et engins ">Autre Véhicules et Engins</a> 
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li><a href="#">Ventes en cours</a></li>
        <li><a href="#">Vendre</a></li>
        <?php if(isset($_SESSION["idUser"])):?>
            <li><a href="<?=$for_nav_path?>dashboard">Compte <img class="nav-ico" id="account-ico" src="<?=$for_nav_path?>assets/icon/account.svg" alt=""> </a></li>
            <li><a href="<?=$for_nav_path?>connexion/disconnect.php">Se déconnecter <img class="nav-ico" id="disconect-ico" src="<?=$for_nav_path?>assets/icon/disconect.svg" alt=""> </a></li>
            <?php else :?>
                <li><a href="<?=$for_nav_path?>connexion/">Se connecter</a></li>
                <li><a href="<?=$for_nav_path?>inscription/">S'inscire</a></li>
        <?php endif;?>
    </ul>
    <div class="nav-set" id="under-nav">
        <ul id="list-under-nav">
            <li id="search_icon">
                <img src="<?=$for_nav_path?>assets/icon/search_btn.svg" alt="">
            </li>
            <li id="searchBar-bloc">
                <input type="text" id="searchBar" placeholder="Recherchez une enchère, un produit etc">
            </li>
        </ul>
    </div>
</nav> 