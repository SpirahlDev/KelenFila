<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;
function sender($numero,$code){

    $sid = "AC64bba57e28f514ec319345de03afb7b5";
    $token = "84fc7cbca0c97f61b70333416bee2cd3";
    $client = new Client($sid, $token);

    $twilioPurchasedNumber = "+15677043548";
    
    // Send a text message
    $message = $client->messages->create(
        $numero,
        [
            'from' => $twilioPurchasedNumber,
            'body' => $code
        ]
    );
    print("Message sent avec success = " . $message->sid ."\n\n");
    
    // Print the last message
    $messageList = $client->messages->read([],1);
    foreach ($messageList as $msg) {
        print("ID:: ". $msg->sid . " | " . "From:: " . $msg->from . " | " . "TO:: " . $msg->to . " | "  .  " Status:: " . $msg->status . " | " . " Body:: ". $msg->body ."\n");
    }

}

?>