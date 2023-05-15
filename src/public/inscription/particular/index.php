<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once("head.php")?>
    <title>Inscription particulier</title>
    <link rel="stylesheet" href="../../general_style/general_style.css">
    <link href="../../general_style/Formulaire.css"  rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <?php require_once("nav-bar.php")?>
    </header>
    <main>
        <form method="post" action="../../../app/controller/userController.php" enctype="multipart/form-data">
            <h3 style="text-align: center; border-bottom: 45px; "> Inscription(particuliers)</h3> <br>
            <div class="container">
                <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="lastname">Prénom:</label>
                    <input type="text" class="form-control" id="prenom" name="prenom">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" class="form-control" id="name" name="nom" placeholder=" Doe" size="">
                    </div>
                </div>
                <div class="col-md-4"> 
                    <div class="form-group">
                    <label for="number">Numéro téléphone:</label>
                    <input type="tel" class="form-control" id="number" name="numero" size="10" maxlength="10">
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="kelenfila@gmail.com">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="city">Ville:</label>
                    <input type="text" class="form-control" id="city" name="ville" size="15">
                    </div>
                </div>
                <div class="col-md-3">
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
                </div>
                <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="adress">Adresse:</label>
                    <input type="text" class="form-control" id="adress" name="adresse" placeholder="BP17 ABIDJAN 17" size="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <input type="hidden" name="q" value="sign">
                    <input type="hidden" name="t" value="particular">
                    
                    <label for="repassword">Confirmation Mot de passe:</label>
                    <input type="password" class="form-control" id="repassword" name="password-confirm">
                    </div>
                </div>
                </div>
            </div>

          
            <div class=" d-flex justify-content-center"><p><input type="radio" name="accord" value="yes" id="wish"> <label for="wish">En continuant l'utilisation vous acceptez
                les <a href="#" style=" color: black;">contrats de licence</a> de KenFilah</label></p>
            </div>

               </div>
               <div class="d-flex justify-content-center  my-5">
                <div id="button-container" class="text-center">
                    <button type="submit" type="submit" id="submit" value="submit" id="submit" >S'inscrire</button>
                </div>
            </div>

        </form>

    </main>
</body>
</html>
