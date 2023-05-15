<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/opt/lampp/htdocs/KelenFila/cron_test/error.log');

    // Créer une instance de la classe Memcached
$memcached = new Memcached();

// Ajouter les serveurs Memcached
$memcached->addServer('127.0.0.1', 11211);  // Adresse IP et port du serveur Memcached

// Exemple : Stocker une valeur dans le cache
$key = 'ma_cle';
$value = array(
    "nom"=>"anselme",
    "speudo"=>"SantosVie"
);

$memcached->set($key, $value);

// Exemple : Récupérer une valeur depuis le cache
$result = $memcached->get($key);
$result["speudo2"]="ansssse";
// Afficher le résultat
echo implode($result);

?>