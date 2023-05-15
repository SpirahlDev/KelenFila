<?php
/**Script destiner à l'affichage des lots, enchere etc, en reponse à une recherche de l'utilisateur **/
session_start();
    require_once("functions.php");
    $typeSearchBy=$_GET["by"];
    if($typeSearchBy==="categorie"){
        if(isset($_SESSION["descriptCategorie"])){
            $descripCategorie=$_SESSION["descriptCategorie"];
            $designCategorie= $_SESSION["designCategorie"];
            $idCat=$_GET["id"];
            $db=use_db(true);
            $requete="SELECT lot.*, enchere.dateEnchere
            FROM lot
            INNER JOIN enchere ON lot.idEnchere = enchere.idEnchere
            WHERE enchere.idCategorie = $idCat
            ORDER BY dateAjout DESC" ;
            $stm=$db->query($requete);
            $lots=$stm->fetchAll(PDO::FETCH_ASSOC);
            $db=use_db(false);
            $attribut='data-current';
            $with="lot"; //or maybe vente
            

        }
        else if(isset($_GET["msg"])&&!empty($_GET["msg"])){
            $msg=$_GET["msg"];
        }
        else{
            header("Location:../../");
        }

        
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once("head.php");?>
    <title><?=$designCategorie?></title>
    <link rel="stylesheet" href="../../general_style/general_style.css">
    <link rel="stylesheet" href="lots.css">
</head>
<body>
    <header>
        <?php require_once("nav-bar.php");?> 
    </header>
    <div id="head-presentation">
        <section id="presentation-cat">
            <div id="kelenLot"></div>
            <div id="categorie-descript">
                <p>
                   <?=$descripCategorie?>
                </p>
            </div>
        </section>
        <section id="choice-by">
            <div id="btns-choice-by">
                <button class="btn-by" id="lot-btn" <?=($with==="lot")?$attribut:"" ?>>
                    <span>Par lots</span>
                </button>
                <button class="btn-by" id="vente-btn" <?=($with==="vente")?$attribut:"" ?>>
                    <span>Par ventes</span>
                </button>
            </div>
        </section>
    </div>
    <main id="principal-lots-screen">
        <section id="sticked-cat-list">
            <div id="title-cat">
                <p>Categorie</p>
            </div>
            <ul id="list-btn-cat">
                <li class="btn-item-list">
                    <input type="radio" name="categorie" value="1" id="ameublement">
                    <label for="ameublement">Ameublement</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="2" id="electromenager">
                    <label for="electromenager">Électroménager et matériel pro.</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="3" id="livres">
                    <label for="livres">Livres</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="4" id="autresVehicules">
                    <label for="autresVehicules">Autres véhicules et engins</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="5" id="voituresSport">
                    <label for="voituresSport">Voitures de sport et de collection</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="6" id="informatique">
                    <label for="informatique">Informatique &amp; Téléphonie</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="7" id="jouets">
                    <label for="jouets">Jouets</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="8" id="horlogerie">
                    <label for="horlogerie">Horlogerie</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="9" id="musique">
                    <label for="musique">Musique</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="10" id="modeBijoux">
                    <label for="modeBijoux">Mode &amp; Bijoux</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="11" id="vinsSpiritueux">
                    <label for="vinsSpiritueux">Vins et spiritueux</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="12" id="collections">
                    <label for="collections">Collections</label>
                  </li>
                  <li class="btn-item-list">
                    <input type="radio" name="categorie" value="13" id="artsDeTable">
                    <label for="artsDeTable">Arts de la table</label>
                  </li>
            </ul>
        </section>
        <div id="bloc-left-safe">
            <section id="screen-for-lots">
                <p id="categorie-name"><?=(!empty($lots)?$designCategorie:"$designCategorie (Pas encore de lots dans cette categorie)")?></p>
                <?php require_once("screenLot.php")?>
            </section>
        </div>
    </main>
    <?php require_once("footer.php")?>
</body>
</html>