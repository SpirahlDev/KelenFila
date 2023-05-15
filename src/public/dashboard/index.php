
<?php session_start(); if(isset($_SESSION["idUser"])):?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once("head.php");
        require_once("root.php");
    ?>
    <link rel="stylesheet" href="tableauDeBord.css"> 
    <title>Tableau de bord</title>
</head>
<body>
    <header>
        <?php require_once("nav-bar.php")?>

    </header>

    <div style="margin-top: 30px;">
        <section class="enteteTableauDeBord"> 
                <div id="encapsulation-H">
                    <article class="jourTableauDeBord">Jours</article>
                    <article class="dateTableauDeBord"><img src="icones/date.svg" alt="" height="20px" style="margin-right: 5px;"><em>01 Avril 2023</em> </article> 
                </div>     
        </section>
    
        
        <h4>Tableau de bord</h4> 
    
        <!--La partie des cellules de la page tableau de bord-->
        <div>
            <!--First section -->
            <section class="blocTableauDeBord1">
                <div class="bloc1">
                    <article class="bloc1_partie1"><img src="icones/marteau.svg" alt=""> <p>Enchères en cours</p> <button class="boutonBloc" >Voir la liste complète</button></article>
                    <article class="bloc1_partie2"><p>4</p></article>
                </div>
                <div class="bloc2">
                    <article class="bloc2_partie1"><img src="icones/dollar.svg" alt=""><p>Liste de paiements</p><button class="boutonBloc">Voir la liste complète</button></article>
                    <article class="bloc2_partie2"><p>3</p></article>
                </div>
                <div class="bloc3">
                    <article class="bloc3_partie1"><img src="icones/marteau2.svg" alt=""><p>Nombre total de ventes</p><button class="boutonBloc">Voir la liste complète</button></article>
                    <article class="bloc3_partie2"><p>30</p></article>
                </div>
                    <div class="bloc4">
                        <article class="bloc4_partie1"><p>Ajouter une enchère</p></article>
                        <article class="bloc4_partie2">
                            <a href="adding/">
                                <button title="Appuyer pour créer une vente aux enchères"><img src="icones/plus.svg" alt=""></button>
                            </a>
                        </article>
                    </div>
            </section>  
    
            <!--Deuxième section -->
            <section class="blocTableauDeBord2">
                <div class="bloc5">
                    <ul>
                        <li>Nombre de lots en ventes</li>
                        <li id="bloc5Nombre"><em>76</em> <img src="icones/pourcentage.svg" alt=""></li>
                        <li> <button class="boutonBloc">Voir liste complète </button></li>
                    </ul>
                </div>
                <div class="bloc6">
                    <ul>
                        <li>Lots total vendues</li>
                        <li id="bloc6Nombre"><em>254</em><img src="icones/pourcentage.svg" alt=""></li>
                        <li><button class="boutonBloc">Voir liste complète </button></li>
                    </ul>
                </div>
                <div class="bloc7">
                    <ul>
                        <li>Revenue total</li>
                        <li id="bloc7Nombre"><em>12 000 000</em>  <img src="icones/dollar.svg" alt=""></li>
                        <li><button class="boutonBloc">Voir liste complète </button></li>
                    </ul>
                </div>
                <div class="bloc8">
                    <ul>
                        <li>Historique de ventes</li>
                        <li id="bloc8Nombre"> <em>542</em><img src="icones/historique.svg" alt=""></li>
                        <li><button class="boutonBloc">Voir liste complète </button></li>
                    </ul>
                </div>
                <div class="bloc9">
                    <ul>
                        <li>Contrat de ventes</li>
                        <li id="bloc9Nombre"><em>76</em> <img src="icones/pourcentage.svg" alt=""></li>
                        <li><button class="boutonBloc">Voir liste complète </button></li>
                    </ul>
                </div>
            </section>
    
            <!--Troisième section -->
            <section class="blocTableauDeBord3">
                <div class="bloc10">
                    <article class="bloc10_partie1"><img src="icones/car.svg" alt=""><p>Lots en attente de livraison</p> <button class="boutonBloc"> Voir liste complète </button></article>
                    <article class="bloc10_partie2"><p>28</p></article>
                </div>
                <div class="bloc11">
                    <article class="bloc11_partie1"><img src="icones/car.svg" alt=""><p>Lots livrés</p><button class="boutonBloc">Voir liste complète</button></article>
                    <article class="bloc11_partie2"><p>12</p></article>
                </div>
                <div class="bloc12">
                    <article class="bloc12_partie1"> <img src="icones/car.svg" alt=""><p>Lots achetés</p> <button class="boutonBloc">Voir liste complète</button></article>
                    <article class="bloc12_partie2"><p>0</p></article>
                </div>
            </section>
        </div>
    
        <!--La partie des paramètre généraux de ventes-->
        <br><br>
        <h4>Paramètres généraux de vente</h4>
    
        <div class="parametreDeVente">
            <section class="parametre_Formulaire">
                <form action="post" id="parametre_Formulaire1"> <p>Définissez des méthodes de paiements</p> 
                    <article class="boutonsMethodesPaiement">
                        <button title="VISA"><img src="icones/visa.svg" alt=""></button>
                        <button title="PayPal"><img src="icones/paypal.svg" alt=""></button>
                        <button title="OrangeMoney"><img src="icones/orangeMoney.svg" alt=""></button>
                        <button title="virement"><img src="icones/virement.svg" alt=""></button>
                    </article><br>
                    <article  class="champPaiementVisa">
                        <label for="Coordonnée">Veuillez entrer vos coordonnées de paiement VISA</label>
                        <textarea name="" id="Coordonnée" cols="80" rows="3 "></textarea>
                    </article>
                </form>
                <form action="post" id="parametre_Formulaire2">
                    <p>Définissez les termes de ventes</p>
    
                    <article>
                        <label for="paiement">Vos modalités de paiements :</label><br>
                        <textarea name="" id="paiement" cols="95" rows="5" placeholder="..."></textarea>
                    </article>
    
                    <article>
                        <label for="livraison">Vos modalités de livraison :</label><br>
                        <textarea name="" id="livraison" cols="95" rows="5" placeholder="Méthode de livraison,etc."></textarea>
                    </article>
    
                   <article>
                    <label for="salutation">Votre formule de salutation (optionnel)</label><br>
                    <textarea name="" id="salutation" cols="95" rows="5" placeholder="Nous vous remercions encore une fois d'avoir participé à notre enchère et..."></textarea><br>
                   </article>
    
                   <article>
                    <label for="autre">Autres(optionnel)</label><br>
                    <textarea name="" id="autre" cols="95" rows="5" placeholder="définissez vos autres modalités ici..."></textarea>
                   </article>
                    
                </form>
            </section>
            <section class="parametre_Infos">
                <article class="parametre_Info1">
                    <img src="icones/aide.svg" alt="">
                    <p>Les méthodes de paiements définit vous aiderons à gagner du temps lors des spécifications du moyen de paiement dans la mise en ligne de vos lots.
                    Vous pouvez aussi en mettre un comme "premier choix" afin que cette méthode de paiement puisse s'applique en premier lieu, à tous vos produits
                    </p>
                </article>
                <article class="parametre_Info2">
                    <img src="icones/aide.svg" alt="">
                    <p>
                        Définissez vos termes de vente et personnaliser vos bordereau d'adjudication qui seront envoyés à vos clients
                    </p>
                </article>
            </section>
        </div>
        
        <button id="enregistrer">Enregitrer</button>


    </div>    
    <footer>
        <div class="footerSection1">
            <section>
                <img id="logoFooter" src="icones/logo.svg" alt="">
                <p id="InfoFooter" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores doloremque nobis voluptates ipsum deleniti similique exercitationem repellendus mollitia sunt possimus, pariatur porro dolor facere est excepturi quo esse reprehenderit dicta!</p>
                <article>
                    <img class="iconeFooter" src="icones/linkedIn.svg" alt="">
                    <img class="iconeFooter" src="icones/twitter.svg" alt="">
                    <img class="iconeFooter" src="icones/youtube.svg" alt="">
                </article>
            </section>
            <section>
                <h4>CONTACTEZ-NOUS</h4>
                <p>+225 2102030405 <br> <br>
                    aide@kelenfila.ci</p>
            </section>
            <section>
                <h4>SERVICES</h4>
                <p>Ventes <br><br>
                    Juridiction</p>
            </section>
            <section>
                <h4>INFORMATIONS</h4>
                <p>A propos de nous</p>
            </section>
        </div>
        <div class="footerSection2"> 
            <p><img src="icones/copyright.svg" alt=""> Kelen Fila, tous droits réservés</p>
            <p><img src="icones/termUse.svg" alt=""> Termes d'utilisation</p>
            <p><img src="icones/PrivacyPolicy.svg" alt=""> Politique de confidentialité</p>
            <p><img src="icones/cookies.svg" alt=""> Politique de cookies</p>
        </div>
    </footer>
</body>
</html>
<?php else:header("Location:../connexion/");
?>
    
<?php endif;?>