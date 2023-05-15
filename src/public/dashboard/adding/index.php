<?php session_start(); if(isset($_SESSION["idUser"])):?>
    <?php 
        require_once("../../../app/config/functions.php");
        $bd=use_db(true);
        $rq="SELECT designCategorie,idCategorie from categorie";
        $categorie=$bd->query($rq);
        $categorie=$categorie->fetchAll(PDO::FETCH_ASSOC);
        $date=date_create();
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    
<?php require_once("head.php")?>
    <title>Ajout d'une enchère</title>
    <link rel="stylesheet" href="style_ajout.css">
    <script src="../../script/jquery.js"></script>

</head>
<body> 
    <header>
        <?php require_once("nav-bar.php")?>

    </header>
    <div id="modal">
        <div class="modal-content">
          <p class="modal-screen"></p>
          <div class="modal-buttons">
            <a href="../">Retourner au tableaux de Bord Tableaux de bord</a>
          </div>
        </div>
    </div>
    <div id="separator">

        <div id="date">
            <div class="date-ctn">
                <div class="day">Jours</div>
                <div id="calendar">
                    <img src="../icones/date.svg" alt="" height="20px" style="margin-right: 5px;">
                    <span><?=$date->format("d/m/Y")?></span>
                </div>
            </div>
        </div>
        <div id="settings">
            <div class="head">
                <span>Ajout d'une enchère</span>
            </div>
            
            <div id="parametre">
                <form action="" method="post">
                    <ul>
                        <li class="param-ctn">Définition des paramètres de ventes</li>
                        <li class="param-ctn">
                            <label for="date-bid">Date de l'enchère</label>
                            <input type="datetime-local" name="dateEnchere" id="date-bid">
                        </li>
                        <li class="param-ctn" id="time-bid">
                            <div>
                                <label for="duree-bid">Durée de l'enchère</label>
                                <input type="time" name="dureEnchere" id="duree-bid">
                            </div>
                            <div>
                                <img src="../icones/aide.svg" width="30px" alt="">
                                <p>À l'approche de ce délai quand une enchère est émise, le temps restant pour l'enchère est remise à 2 minutes </p>
                            </div>
                        </li>
                        <li class="param-ctn">
                            <label for="categorie">Définissez la catégorie de vente</label>
                            <select name="categorie" id="categorie">
                                <option value="">-------------</option>
                                <?php foreach($categorie as $cat):?>
                                    <option value="<?=$cat["idCategorie"]?>"><?=$cat['designCategorie']?></option>
                                <?php endforeach;?>
                            </select>
                        </li>
                    </ul>
                </form>
            </div>
    
        </div>
        <section id="lotPart">
            <div id="titre-lotPart"><span>Ajout de lots</span></div>
            <div id="control-box">
                <div>
                    <label for="compteur">Ajouter des lots</label for="compteur">
                    <div class="screen-ctrl">
                        <input type="number" value="1" min="1" id="compteur" class="num">
                        <button id="plus">+</button>
                    </div>
                    <button class="modifier" id="save">Enregistrer</button>
                </div>
            </div>
            <div class="notify" id="notification-screen">
                <div id="notification">
                    <span class="noti-text"></span>
                    <img src="" alt="" class="close-btn">
                </div>
            </div>
            <form action="" method="post" class="box-lot">
                <div class="number">
                    <span>Lot numero 
                        <span class="numero-lot">1</span>
                    </span>
                </div>
                <article class="principal-ctn">
                    <div class="supr">
                        <div class="supr-btn">
                            <img src="../icones/delete-icon.svg" width="30px" alt="">
                            <span>Supprimer</span>
                        </div>
                    </div>
                    <ul>
                        <li class="champs">
                            <div>
                                <label for="lot-name">Nom du produit</label>
                                <input type="text" name="designLot" id="lot-name">
                            </div>
                            <div>
                                <label for="estimation">Estimation</label>
                                <input type="text" name="prix" id="estimation">
                            </div>
                        </li>
                        <li class="champs">
                            <div>
                                <label for="descript">Description générale</label>
                                <textarea name="descriptionLot" id="descript" cols="30" rows="10"></textarea>
                            </div>
                            <div>
                                <label for="mot-etat">Mot sur l'état du produit</label>
                                <input type="text" name="etatLot" id="mot-etat">
                            </div>
                        </li>
                        <li class="champs">
                            <div class="info-for-lot-img">
                                <span>Photographies du produit</span>
                                <span>*Pour garantir la satisfaction de nos client, toutes les 5 images sont obligatoires</span>
                            </div>
                            <div class="img-list-part">
                                <div class="bloc-img">
                                    <input type="file" class="img-input" name="image1" id="image1">
                                    <div class="img-disp">
                                        <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                                    </div>
                                    <label for="image1">Image 1 (principal)</label>
                                </div>
                                <div class="bloc-img">
                                    <input type="file" class="img-input" name="image2" id="image2">
                                    <div class="img-disp">
                                       <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                                    </div>
                                    <label for="image2">Image 2</label>
                                </div>
                                <div class="bloc-img">
                                    <input type="file" class="img-input" name="image3" id="image3">
                                    <div class="img-disp">
                                       <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                                    </div>
                                    <label for="image3">Image 3</label>
                                </div>
                                <div class="bloc-img">
                                    <input type="file" class="img-input" name="image4" id="image4">
                                    <div class="img-disp">
                                       <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                                    </div>
                                    <label for="image4">Image 4</label>
                                </div>
                                <div class="bloc-img">
                                    <input type="file" class="img-input" name="image5" id="image5">
                                    <div class="img-disp">
                                       <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                                    </div>
                                    <label for="image5">Image 5</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </article>
            </form>
        </section>
        <div id="shape-notify">
            <div id="content-notify">
                <p>Contenu de la forme ici</p>
                <div id="close-btn-notify">&times;</div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="../../script/informing.js"></script>
</body>
</html>
<?php else: header("Location:../../connexion/");?>

<?php endif;?>