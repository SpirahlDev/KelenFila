<!DOCTYPE html>
<html lang="fr">
    <head>
       <?php require_once("head.php")?>
        <title>Connection</title>
        <link href="../general_style/Formulaire.css"  rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </head>
<body>
    <header>
        <?php require_once("nav-bar.php");?>
    </header>
    <main>
        <h3>Connexion</h3>
        <div>
            <form class="formulaire" action="../../app/controller/userController.php" method="post">
                <div class="container ">
                    <div class="row justify-content-md-center" >
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="adress"> Email:</label>
                            <input type="email" class="form-control" id="adress" name="email" placeholder=" Doe@gmail.com " size="">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6 ">
                            <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder=" mot de passe">
                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-center  my-5">
                        <div id="button-container" class="text-center">
                            <button type="submit" type="submit" id="submit" value="submit" id="submit" >Se connecter</button>
                        </div>
                </div>
                <div class="row justify-content-md-center">
                    <input type="hidden" name="q" value="login">
                    <div class="col-md-3 " style="padding-left: 40px;">
                        <div class="form-group">
                        <p><a href="#" style="color:black">Mot de passe oublié?</a></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <p><a href="../inscription/" style="color:black">Pas encore de compte?</a></p>
                        </div>
                    </div>
                </div>



            </form>
        </div>

    </main>

</body>
</html>
