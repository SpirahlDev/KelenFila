<?php
    // * * * * * php /opt/lampp/htdocs/KelenFila/src/app/config/checkCache.php
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', '/opt/lampp/htdocs/KelenFila/cron_test/error.log');
    
    

    $pathToServer="/opt/lampp/htdocs/KelenFila/src/app/ENCHERE/server.php ";
    $pathOutput="> /opt/lampp/htdocs/KelenFila/cron_test/output.txt";
    
    $cache=new Memcached();
    $cache->addServer('127.0.0.1', 11211);  // Adresse IP et port du serveur Memcached
    $key="ENCH";
    $encheres=$cache->get($key);
    $now=date_create();
    $hourNow=$now->format("H:i");
    foreach($encheres as $index=>$ench){
        if($ench["heure"]==$hourNow){
            $tab=$cache->get($key);
            $tab[$index]["isStarted"]=1;
            $cache->set($key,$tab);
            exec("php ".$pathToServer." ".$ench["port"]." ".$ench["idEnchere"]." ".$pathOutput." &");
        }
        
    }

?>