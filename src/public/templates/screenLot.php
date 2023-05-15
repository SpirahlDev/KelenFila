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
                <a href="">
                    <div class="card-bloc-img">
                        <img src="<?="../".$lot["image1"]?>" alt="montre">
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
                            <a href="#">
                                <button class="action-btn">Participer <img src="" alt=""></button>
                            </a>
                        </li>
                    </ul>
                </a>
                
            </li>
            <?php endforeach;?>
        </ul>
    </section>
    <script src="../"></script>