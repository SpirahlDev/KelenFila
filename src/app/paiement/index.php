<?php

require_once("paypalPaiement.php");
use Pay\PaypalPaiement as Paypal;

$paypal=new Paypal();
echo $paypal->ui();
?>