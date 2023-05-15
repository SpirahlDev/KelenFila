<!DOCTYPE html>
<html lang="fr">
<head> 
    <?php require_once("head.php")?>
    <title>Inscription entreprise</title>
    <link href="Formulaire.css"  rel="stylesheet">
    <link rel="stylesheet" href="../../general_style/general_style.css">
    <link href="../../general_style/Formulaire.css"  rel="stylesheet">
    <script src="../../script/jquery.js"></script>
    <script src="script_balance.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <?php require_once("nav-bar.php");?>

    </header>
    <main id="sign-main-bloc">
        <div id="long-header">
            <h3 style="text-align: center; "> Inscription(entreprise)</h3> 
            <div id="type-btn">
                <button class="choice-actor" id="entreprise-type-btn"> 
                    <span> Entreprise</span></button>
                <button class="choice-actor" id="commissaire-type-btn"> 
                    <span>Commissaire Priseur</span></button>
            </div>
        </div>
        <br>
        <form action="../../../app/controller/userController.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="society_name">Nom de Société</label>  
                                <input class="form-control"  type="text" id="society_name" name="nomEntreprise" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="country">Pays:</label>
                            <select class="form-control" name="pays" id="country">
                                <option value="Côte d'ivoire">Côte d'ivoire</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Mali">Mali</option>
                                <option value="Benin">Benin</option>
                                <option value="Togo">Togo</option>
                                <option value="Niger">Niger</option>
                                <option value="Guinée-Bissau">Guinée-Bissau</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">Ville</label>  
                                <input class="form-control"  type="text" id="city" name="ville" placeholder = "Man" size="15">
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="adress">Adresse</label> 
                                <input class="form-control"  type="text" id="adress" name="adresse" placeholder = "BP07 Man 07" size="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Nom</label>  
                                <input class="form-control"  type="text" id="name" name="nom" size="" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="prenom">Prénom</label>  
                                <input class="form-control"  type="text" id="prenom" name="prenom" >
                            </div>
                        </div>
                    <input type="hidden" name="q" value="sign">
                    <input type="hidden" name="t" value="enterprise">
                    </div>
                    <div class="row" >
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="function">Poste dans l'entreprise</label>  
                                <input class="form-control"  type="text" id="function" name="poste">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="number">Numéro téléphone:</label>
                            <input type="tel" class="form-control" id="number" name="numero" size="10" maxlength="20">
                        </div>
                </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label> <input class="form-control"  type="email" id="email" name="email" placeholder = "entreprise@gmail.com" >
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Mot de passe</label> 
                                <input class="form-control"  type="password" id="password" name="password" placeholder = "" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="repassword">Confirmation Mot de passe</label> 
                                <input class="form-control"  type="password" id="repassword" name="password-confirm" >
                            </div>
                        </div>
                    </div>
                    <div class="row" id="last-row" >
                        <input type="radio" name="accord" value="yes" id="wish"> 
                        <label id="lbl" for="wish">En continuant l'utilisation vous acceptez
                            les <a href="#" style=" color: black;">contrats de licence</a> de KenFilah</label>
                        
                    </div>
                </div>


            </div>
            <div class="d-flex justify-content-center my-5">
                <div id="button-container" class="text-center">
                    <button type="submit" type="submit" id="submit" value="submit" id="submit" >S'inscrire</button>
                </div>
            </div>

        </form>


    </main>
</body>
</html>
