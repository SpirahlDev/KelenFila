<?php
    // 0 * * * * /opt/lampp/htdocs/KelenFila/src/app/config/readDB.php
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', '/opt/lampp/htdocs/KelenFila/cron_test/error.log');
    require_once("/opt/lampp/htdocs/KelenFila/src/app/config/functions.php");
    require_once("/opt/lampp/htdocs/KelenFila/src/app/config/portManager.php");

    $cache=new Memcached();
    $cache->addServer('127.0.0.1', 11211);  // Adresse IP et port du serveur Memcached
    $key="ENCH";
    $tabEnch=array();
    $cache->add($key,$tabEnch);
 

    $now=date_create();
    $date=$now->format("Y-m-d");
    $db=use_db(true);
    $requet="SELECT idEnchere,dateEnchere from enchere where DATE(dateEnchere)='$date'";
    $result=$db->query($requet);
    $result=$result->fetchAll(PDO::FETCH_ASSOC);
    $db=use_db(false);

    if(!empty($result)){
        echo "lan";
        foreach($result as $rsl){
            $hour=date_create($rsl["dateEnchere"]);
           
            if($hour->format('H')==$now->format('H')){
                $ench=array(
                    "idEnchere"=>$rsl["idEnchere"],
                    "heure"=> $hour->format('H:i'),
                    "port"=>$port,
                    "isStarted"=>0
                );
                $tab=$cache->get($key);
                $tab[]=$ench;
                $cache->set($key,$tab);
            }

        }
    }
   
?>