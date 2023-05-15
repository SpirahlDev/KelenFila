<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once '/path/to/vendor/autoload.php';

use Twilio\Rest\Client;

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$sid = getenv("AC64bba57e28f514ec319345de03afb7b5");
$token = getenv("84fc7cbca0c97f61b70333416bee2cd3");
$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("+2250102804964", // to
                           ["body" => "Test numero 1", "from" => "+15677043548"]
                  );

print($message->sid);