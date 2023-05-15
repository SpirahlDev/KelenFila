<?php
    if (!function_exists('curl_init')) {
        throw new Exception('La bibliothèque cURL est requise pour utiliser l\'API PayPal.');
    }
    $client_id="ASmQ0lyvBn2lTumkoFG4HzRXuPLqYIgxp3Y7GOH-CJybvgyS3WHvu80fWLEnn_R67GroUnjW5LX31SBz";
    $client_secret="";
    $paypal_url="https://api-m.sandbox.paypal.com";
    $lot=json_decode($_POST["cart"],true);

    $data=[
        'intent'=>'CAPTURE',
        'purchase_units'=>[
            [
                'amount'=>[
                    'currency_code'=>'USD',
                    'value'=>'5.00' //montant total de la transaction
                ],
                'items'=>array_map(function($item) {
                    return [
                        'name' => $item['name'], // nom de l'article
                        'quantity' => $item['quantity'], // quantité de l'article
                        'unit_amount' => [
                          'currency_code' => 'USD',
                          'value' => $item['price'], // prix unitaire de l'article
                        ],
                      ];
                },$lot)

            ]
        ]
    ];

    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$paypal_url.'/v2/checkout/orders');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
      ]);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      // exécuter la requête API PayPal
      $response = curl_exec($ch);
      curl_close($ch);
      
      // retourner la réponse de l'API PayPal au client (qui contient l'ID de commande)
      header('Content-Type: application/json');
      
      echo $response;

?>