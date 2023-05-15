<?php session_start();


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
                            <img src="#" alt="arrow">
                        </span>
                    </button>
                </form>
            </div>
            <div class="div_under_lot" id="bloc-lot-description">
                <div class="a-propos">

                </div>
                <ul id="description-element">
                    <li>Voiture | Vintage</li>
                    <li>Bugatti Type 57</li>
                    <li>
                        <span>Esatimation</span>
                        <span>34.00000000 <span #id="price">FCFA</span></span>
                    </li>
                    <li>
                        <p>Historique</p>
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est unde cumque vel omnis voluptatibus quaerat ea eum nesciunt cupiditate similique, aliquam at ratione veritatis laboriosam eaque necessitatibus eos fugiat. Magnam.
                            Id aut pariatur nesciunt neque hic itaque, vero ducimus dicta consequuntur, quasi voluptates debitis totam voluptate molestiae suscipit. Sunt mollitia beatae, omnis quo inventore vitae minus debitis molestiae suscipit voluptate.
                        </p>
                    </li>
                    <li>
                        <span #id="etat-lot">
                            Quasi Neuf
                        </span>
                        <span>
                            Vendeur
                        </span>
                        <span>
                            Jean François
                        </span>
                    </li>
                    <li id="info-divers">
                        <span>Lot 2 du cataglogue</span>
                        <span>Voiture De Luxe Vintage</span>
                    </li>
                </ul>
            </div>
        </article>
        <script src="../script-lot.js"></script>
    </header>



    <?php require_once("footer.php")?>
</body>
</html>