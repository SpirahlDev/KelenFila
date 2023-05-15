<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once("head.php");?>
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title> 
</head>
<body>
    <?php require_once("nav-bar.php");?> 
    <header id="section-choix">
        <div id="choice-route">
            <ul id="choices-list">
                <li class="choices-item">
                    <a href="professionnel/">
                        <div class="choix" id="prof-choice">
                            <p class="professionnel">S'inscrire en tant que professionnel</p>
                        </div>
                    </a>
                    <p class="info-choix">
                        *Vous êtes une organisation, une entreprise ou un professionnel du domaine des ventes aux enchères
                    </p>
                </li>
                <li class="choices-item">
                    <a href="particular/">
                        <div class="choix"  id="parti-choice">
                            <p class="particular">S'inscrire en tant que particulier</p>
                        </div>
                    </a>
                    <p class="info-choix">
                        *Vous êtes un particulier désireux de participez aux ventes
                    </p>
                </li>
            </ul>
        </div>
    </header>
    
</body>
</html>