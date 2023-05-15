<?php
    session_start();
    header('Content-Type: application/json'); 
    require_once("../config/functions.php"); 
    require_once("../model/userHandling.php");
    $data=$_POST;
    $alert=null;
    //pour les cas d'inscription
    if(isset($_POST["q"],$_POST["t"])&&$_POST["q"]=="sign"){ //for sign in case
        $quest=$_POST["t"];
        if(!Ifempty($data)){
            if($quest=="particular" ){
                if(isset($data["accord"]) && $data["accord"]==="yes"){
                    $data["typeUser"]="particulier";
                    $verif=passwordChecker($data);
                    if($verif==="OK"){
                        $particul=new particulier($data);
                        $particul->createParticulier();
                        header("Location:../../public/connexion/");
                        exit();
                    }
                    else{
                        $alert = urlencode($verif);
                        header("Location:../../public/inscription/?alert=" . $alert);
                    }
                }
                else{
                    // header("Location:../../public/");
                }
            }
            else if($quest=="enterprise"){  
                if(isset($data["accord"]) && $data["accord"]=="yes"){
                    $data["typeUser"]="entreprise";
                    $verif=passwordChecker($data);
                    if($verif==="OK"){
                        $enterprise=new entreprise($data);
                        $enterprise->createEntreprise();
                        header("Location:../../public/connexion/");
                        exit();
                    }
                    else{
                        $alert = urlencode($verif);
                        header("Location:../../public/inscription/?alert=" . $alert);
                    }

                }
                else{
                    // header("Location:../../public/");
                }
               
            }
            else if($quest=="commissaire"){
                if(isset($data["accord"]) && $data["accord"]==="yes"){
                    $data["typeUser"]="commissaire-priseur";
                    $verif=passwordChecker($data);
                    if($verif==="OK"){
                        $particul=new commissaire($data);
                        $particul->createCommissaire();
                        header("Location:../../public/connexion/");
                        exit();
                    }
                    else{
                        $alert = urlencode($verif);
                        header("Location:../../public/inscription/?alert=" . $alert);
                    }
                }
                else{
                    // header("Location:../../public/");
                }
            }
            else {
                http_response_code(400);
                echo json_encode(["error" => "Paramètre de requete invalides"]);
                exit();
            }

        }
        else{
            $alert = urlencode("Le formulaire n'as pas été convenablement remplis");
            header("Location:../../public/inscription/?alert=" . $alert);
        }

    }

    //Pour les cas de connexion
    else if(isset($_POST["q"])&&$_POST["q"]=="login"){    //for connexion
        if (!isset($data["email"], $data["password"])&&empty($data["email"])||empty($data["password"])){
            http_response_code(400);
            echo json_encode(["error" => "Certains champs sont manquant"]);
            exit();
        }
        $email=$_POST["email"];
        $psw=$_POST["password"]; 
        control_entry($email,$pws);
        $retour=user::getUser($email);
        if(!empty($retour)){
            if(password_verify($psw,$retour["password"])){ 
                if($retour["typeUser"]=="particulier"){
                    $infos=particulier::getSpecific($retour["idUser"]);
                    if(!empty($infos)){
                        $_SESSION["idUser"]=$retour["idUser"];
                        $_SESSION["type_user"]="particulier";
                        $_SESSION["designUser"]=$infos["nomParticul"].$infos["prenomParticul"].$retour["idUser"];
                        foreach($infos as $key=>$value){
                            $_SESSION[$key]=$value;
                        }           
                        http_response_code(200);                                   /*Il est recommandé de stocker les informations d'utilisateur sensibles dans des variables de session plutôt que de les renvoyer directement en réponse. Cela réduira le risque de vulnérabilité en cas de fuite de données.*/ 
                        header("Location:../../public/");
                        // exit();
                    }
                    else $alert="Aucun compte correspondant";
     
                }
                else if($retour["typeUser"]=="entreprise"){
                    $infos=entreprise::getSpecific($retour["idUser"]);
                    if(!empty($infos)){
                        $_SESSION["idUser"]=$retour["idUser"];
                        $_SESSION["type_user"]="entreprise";
                        $_SESSION["designUser"]=$retour["designEntreprise"];
                        foreach($infos as $key=>$value){
                            $_SESSION[$key]=$value;
                        }
                        http_response_code(200);                                   /*Il est recommandé de stocker les informations d'utilisateur sensibles dans des variables de session plutôt que de les renvoyer directement en réponse. Cela réduira le risque de vulnérabilité en cas de fuite de données.*/ 
                        header("Location:../../public/");
                        // exit();
                    }
                    else $alert="Aucun compte correspondant";
                }
                else if($retour["typeUser"]=="commissaire-priseur"){
                    $infos=commissaire::getSpecific($retour["idUser"]);
                    if(!empty($infos)){
                        $_SESSION["idUser"]=$retour["idUser"];
                        $_SESSION["type_user"]="Commissaire-priseur";
                        $_SESSION["designUser"]=$infos["nomComPr"].$infos["prenomComPr"].$retour["idUser"];
                        foreach($infos as $key=>$value){
                            $_SESSION[$key]=$value;
                        }           
                        http_response_code(200);                                   /*Il est recommandé de stocker les informations d'utilisateur sensibles dans des variables de session plutôt que de les renvoyer directement en réponse. Cela réduira le risque de vulnérabilité en cas de fuite de données.*/ 
                        header("Location:../../public/");
                        // exit();
                    }
                    else $alert="Aucun compte correspondant";
     
                }
    
            }
            else{
                $alert="Mot de passe ou email incorrect";
            }

        }
        else $alert="Aucun compte lié à cet email";
        if($alert!=null){
            header('Content-Type: application/json');
            header("Location:../../public/connexion/");
            $alert=array("alert"=>$alert);
            $alert=json_encode($alert);
            echo $alert; 
        }
    }
    else{
        header("Location:../../public/");
    }
?>