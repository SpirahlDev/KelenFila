<?php
require_once("/opt/lampp/htdocs/KelenFila/src/app/config/functions.php");
$port = mt_rand(9000, 11000);
while (!isPortAvailable($port)) {
    $port = mt_rand(9000, 11000);
}

?>