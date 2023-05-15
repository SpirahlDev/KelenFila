<?php require_once("root.php");
$for_footer_path=ROOT_PROJECT.'src/public/assets/icon/';
?>
<footer>
        <div class="footerSection1">
            <section>
                <img id="logoFooter" src="<?= $for_footer_path?>logo.svg" alt="">
                <p id="InfoFooter" >Bienvenue sur KelenFila, le site d'enchères en ligne de référence en Côte d'Ivoire. Sur notre plateforme, vous trouverez de tout : art ancien ou moderne, électronique, livres, automobiles, etc. Bénéficiez d'un service de qualité et de produits certifiés par des experts.</p>
                <article>
                    <img class="iconeFooter" src="<?= $for_footer_path?>linkedIn.svg" alt="">
                    <img class="iconeFooter" src="<?= $for_footer_path?>twitter.svg" alt="">
                    <img class="iconeFooter" src="<?= $for_footer_path?>youtube.svg" alt="">
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
            <p><img src="<?= $for_footer_path?>copyright.svg" alt=""> Kelen Fila, tous droits réservés</p>
            <p><img src="<?= $for_footer_path?>termUse.svg" alt=""> Termes d'utilisation</p>
            <p><img src="<?= $for_footer_path?>PrivacyPolicy.svg" alt=""> Politique de confidentialité</p>
            <p><img src="<?= $for_footer_path?>cookies.svg" alt=""> Politique de cookies</p>
        </div>
    </footer>