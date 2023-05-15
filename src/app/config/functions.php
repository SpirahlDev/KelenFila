 <?php 
    function control_entry(&...$entry){
        foreach($entry as &$etr){
            $etr=trim($etr);
            $etr=strip_tags($etr); 
        }
    }

    function file_check($file,$special=""){
        //ecrire spécial pour resevoir un tableaux de valeurs plus tard
        $allowed=array('jpeg','jpg','png','jfif','webp');
        $rt=false;
        if($special!=""){
            $allowed[]=$special;
        }
        if($file['size']<=6000000 && $file["error"]==0){
            $extension=pathinfo($file['name'],PATHINFO_EXTENSION);
            $rt=in_array($extension,$allowed); 
        }
        
        // if(!$rt)
        //     throw new Exception("Fichier non supporté");
        return $rt;
       
    }
    function use_db(bool $intention){
        require("/opt/lampp/htdocs/KelenFila/src/app/config/connect.php");
        $r;
        if($intention){
            try{
                $BDD=new PDO($dsn,$login,$password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                $r=$BDD;
            }catch(Exception $e){
                echo("Erreur :".$e->getMessage());
            }
        }
        else{
            $BDD=null;
            $r=$BDD; 
        }
        return $r;
    }
    function redirection_go_back($alert){
        //mettre une redirection qui verifie si le reffere est égal à connecion;Si oui, go to dashboard
        header("Location:".$_SERVER["HTTP_REFERER"]."?alert=".$alert);
    }
    function alert_retour_json($alert){
        
    }

    function json_response(array $tab){
        $result=json_encode($tab);
        return $result;
    }
 
    function passwordChecker($psw){
        $check=false;
        if($psw["password-confirm"]===$psw["password"]){
            if(strlen($psw["password"])>8){
                $pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_])(?=.*\d)[A-Za-z\d\W_]{8,}$/";
                if(preg_match($pattern,$psw["password"])){
                    $check="OK";
                } else {
                    $alert="Votre mot de passe n'est pas assez sécurisé";
                }
                

            }
            else
                $alert="Votre mot de passe doit contenir au moins 8 caractères";

        }
        else
            $alert="Votre mot de passe ne correspond pas.";

        return (!$check)?$alert:$check;
    }

    function Ifempty($data):bool{
        //retourne true si un element n'est pas défini ou est vide
        $conform=false;
        foreach($data as $elm){
            if(empty($elm)||!isset($elm)){
                $conform=true;
                break;
            }
        }
        return $conform;
    }
    function isPortAvailable($port):bool{
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $result = socket_bind($socket, '127.0.0.1', $port);
        socket_close($socket);
        return $result;
    }
?>