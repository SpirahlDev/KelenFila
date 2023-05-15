<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="styleChat.css">
</head>  
<body>
    <div id="modal">
        <div class="modal-content">
          <p>Voulez-vous Vraiment quitter l'enchère ?</p>
          <div class="modal-buttons">
            <button id="btn-oui">Oui</button>
            <button id="btn-non">Non</button> 
          </div>
        </div>
    </div>
    <main>
        <section id="description">
            <ul id="left-content">
                <li class="left-items">
                    <h5>Description du produit</h5>
                </li>
                <li class="left-items">
                    <div class="item-img">
                        <img src="buggatti_57.png" alt="buggati">
                    </div>
                </li>
                <li class="left-items" id="general-infos">
                    <ul id="general-items">
                        <li>
                            <p id="design-Lot">Bugatti Type 57</p>
                        </li>
                        <li>
                            <p id="numero-Lot">Lot <span>2</span> du catalogue</p>
                        </li>
                        <li>
                            <p id="prix-lot"></p>
                            <span id="devise-left">FCFA</span>
                        </li>
                        <li>
                            <p id="etat">Quasi Neuf</p>
                        </li>
                        <li>
                            <p>Voiture De Luxe Vintage</p>
                        </li>
                    </ul>
                </li>
                <li class="left-items" id="general-infos">
                    <p>Description</p>
                    <div id="text-descript">
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae quae eligendi suscipit aliquid repudiandae iure rem cum eveniet. Ad, nisi. Expedita reiciendis tempora facere? Culpa eveniet eaque nemo vero amet!
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates asperiores quas accusamus aliquid esse, eligendi quo dolor nobis aliquam, quisquam vero aut, sapiente nam temporibus ad iste nostrum debitis explicabo!
                        </p>
                    </div>
                </li>
                <li class="left-items" id="settings">
                    <div class="exit-btn">
                        <img src="assets/exit.svg" alt="">
                    </div>

                </li>
            </ul>
        </section>
        <section id="interface">

            <section id="ecran"></section>
    
            <section id="controle">
                <div id="skip">
                    <div id="skip-btn">
                        <img src="assets/skip.svg" alt="">
                        <span>Passer ce produit <span></span></span>
                    </div>
                    <div class="div-arb">
                        <span id="vote">
                            0/13
                        </span> 
                        <span class="span-arb">
                            votes
                        </span>
                    <input type="hidden" id="port" name="port" value="<?=$port?>">
                    <input type="hidden" id="idEnchere" name="idEnchere" value="<?=$verif?>">
                    </div>
                </div>
                <div id="bloc-under">
                    <div class="under-left">
                        <button id="fast-btn-l" class="plus-btn">+5.000FCFA</button>
                        <button id="fast-btn-r" class="plus-btn">+10.000FCFA</button>
                    </div>
                    <div class="under-right">
                        <div class="box-auction">
                            <label for="prix-encherir">Entrez votre prix</label>
                            <div class="action-input">
                                <input type="number" min="0" value="0" step="1000" id="prix-encherir">
                                <button id="btn-encherir">
                                    <span>Encherir</span>
                                    <span>
                                        <span id="prix"></span>
                                        <span>FCFA</span>
                                    </span>
                                </button>
                            </div>

                        </div>
                        <div id="rebourd">
                            <span id="delai">
                                20s
                            </span>
                            <span id="duree"></span>
                        </div>
                    </div>
                </div>
                
            </section>
        </section>
    </main>
</body>
</html>