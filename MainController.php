<?php
session_start();
require_once("endpoint_responses.php");
$post=(isset($POST["request"]))?$POST["request"]:false;
$get=(isset($_GET["search"])&&!empty($_GET["search"]))?$_GET["search"]:false;

if(isset($_POST["search"],$_POST["header"])&&!empty($_POST["search"])){
    $post=$_POST["request"];
    $post=json_decode($post,true);

    switch($_POST['header']){
        case "produit" : 
            fetch_produit($post);
            break;
        case "vendeur" :
            fetch_vendeur($post);
            break; 
        case "getIn":
            getInRoom($post);
            break;
        case "rappel":
            putRappel($post);
            break;
    }

}
if(isset($_GET["search"],$_GET["header"])&&!empty($_GET["search"])){
    switch($_GET["header"]){
        case "categorie-search":
            $get=$_GET["search"];
            echo $get;
                $cat=check_categorie_ifexist($get);
                if(($cat)){
                    $_SESSION["descriptCategorie"]=$cat["descriptCategorie"];
                    $_SESSION["designCategorie"]=$cat["designCategorie"];
                    header("Location:../../public/produit/KelenLots/lots.php?by=categorie&id=".$cat["idCategorie"]);
                }
                else{
                    unset( $_SESSION["descriptCategorie"],$_SESSION["designCategorie"]);
                    // header("Location:../../public/produit/KelenLots/lots.php?by=categorie&id=".$cat["idCategorie"]);
                }
        break;
    }

}

?>