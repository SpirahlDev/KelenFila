<?php 
require __DIR__. '/vendor/autoload.php';
require("Chat.php");
use Ratchet\Server\IoServer;
use ChatApp\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
    $idEnchere=0; //idenchere est renseigné par le lancement via cron
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat($idEnchere)
            )
        ),
        8086
    ); 

    $server->run();
?>