<?php require_once("root.php");?>
<section id="bloc-article">  
        <ul id="ul_under_bloc-article">
            <?php foreach($lots as $lot):?>
            <li class="card-lot">
                <?php 
                    $now=date_create();
                    $date=date_create($lot["dateEnchere"]);
                    $diff=$date->diff($now);
                    if(!$diff->invert &&!$lot["isEnded"]){
                        $status="Enchère en cours";
                    }
                    else if(!$lot["isEnded"]){
                        $status=$date->format('d/m/Y H:i');
                    }
                    else if($lot["isEnded"]){
                        $status="Enchère terminée";
                    }
                ?>
                <a href="<?=ROOT_PROJECT."src/public/produit/description/information.php?idLot=".$lot["idLot"]?>">
                    <div class="card-bloc-img">
                        <img src="<?=ROOT_PROJECT.$lot["image1"]?>" alt="montre">
                    </div>
                    <ul class="descript-card">
                        <li class="lot">
                            <span class="numLot">Lot <?=$lot["numeroLot"] ?></span>
                            <span class="rigth-span-etat">
                                <?=$status?>
                            </span> 
                        </li>
                        <li class="designLot">
                            <span class="left-span">Nom</span>
                            <span class="rigth-span"><?=$lot["designLot"] ?></span>
                        </li>
                        <li class="prixLot">
                            <span class="left-span">Estimation</span>
                            <span class="rigth-span"><?=$lot["estimatLot"] ?> FCFA</span>
                        </li>
                        <li class="descriptLot">
                            <p><?=$lot["descriptionLot"] ?></p>
                        </li>
                        <li class="action-bloc">
                            <?php if(!$diff->invert &&!$lot["isEnded"]):?>
                                <form method="post" action="<?=ROOT_PROJECT.'src/app/controller/'?>MainController.php" id="toEnchere">
                                    <input class="action-btn" type="submit" value="Participer">
                                    <input type="hidden" name="header" value="getIn">
                                    <input type="hidden" name="request" value="<?=$lot["idEnchere"]?>">
                                </form>
                            <?php elseif(!$lot["isEnded"]):?>
                                    <div id="callMeBack">
                                        <input class="action-btn" type="submit" value="Me Prévenir">
                                        <input type="hidden" name="header" value="rappel">
                                        <input type="hidden" name="request" value="<?=$lot["idLot"]?>">
                                    </div>
                            <?php endif;?>
                        </li>
                    </ul>
                </a>
                
            </li>
            <?php endforeach;?>
        </ul>
    </section>
    <script src="../"></script>