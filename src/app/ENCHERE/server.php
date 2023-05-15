<?php 
require __DIR__. '/vendor/autoload.php';
require("RoomEnchere.php");
use Ratchet\Server\IoServer;
use EnchereApp\Enchere;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

    $port=$argv[1];
    $idEnchere=$argv[2]; //idenchere est renseigné par le lancement via cron
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Enchere($idEnchere) 
            )
        ),
        $port 
    ); 

    $server->run();
    
?>  