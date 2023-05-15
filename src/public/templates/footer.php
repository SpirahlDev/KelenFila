<?php require_once("root.php");
$for_footer_path=ROOT_PROJECT.'src/public/assets/icon/';
?>
<footer>
        <div class="footerSection1">
            <section>
                <img id="logoFooter" src="<?= $for_footer_path?>logo.svg" alt="">
                <p id="InfoFooter" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores doloremque nobis voluptates ipsum deleniti similique exercitationem repellendus mollitia sunt possimus, pariatur porro dolor facere est excepturi quo esse reprehenderit dicta!</p>
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