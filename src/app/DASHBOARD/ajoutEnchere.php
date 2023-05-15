<?php
    require_once("dashboardController.php");
    $data=$_POST;
    $alert["status"]="";
    if(isset($_SESSION["idUser"],$_SESSION["designUser"])){
        
        $isOneEmpty=false;
        foreach($data as $value){
            if(empty($value)){
                $isOneEmpty=true;
                break;
            }
        }
        echo $isOneEmpty;
        if(!$isOneEmpty){
            $idVendeur=$_SESSION["idUser"];
            $designUser=$_SESSION["designUser"];
            if(!isset($_SESSION["idEnchere_add"])){
                $idEnchereCreated=dashboard::ajouterEnchere($data,$idVendeur);
                if($idEnchereCreated) {
                    $_SESSION["idEnchere_add"]=$idEnchereCreated;
                    $_SESSION["nbFormulaires"]=$data["nb_formulaires"];
                    $alert["value"]="Enchère créé avec succès"; 
                    $alert["status"]="OK";
                }
                else{
                    $alert["value"]="Echec, une erreur s'est produite lors de la création de votre enchère";
                    $alert["status"]="ERROR";
                }
            }
            else{
                $conf=dashboard::ajouterLot($data,$_SESSION["idEnchere_add"],$designUser);
                if($conf==1){
                    $_SESSION["nbFormulaires"]-=1;
                    $alert["value"]=$data["designLot"]." ajouté avec succès";
                    $alert["conf"]="OK";
                }
                else{
                    $alert["value"]=$conf;
                    $alert["conf"]="ERROR";
                }
            }
        }
        else{
            $alert["value"]="Certains champs sont restés vides";
            $alert["status"]="ERROR";
        }
    }
    else{
        header("Location:../../public/connexion/");  
    }
    if($_SESSION["nbFormulaires"]===0||$alert["status"]==="ERROR"){
        unset($_SESSION["idEnchere_add"]);
        unset($_SESSION["nbFormulaires"]);
    }

    $alert=json_encode($alert);
    header("Content-Type:application/json");
    echo $alert;
?>