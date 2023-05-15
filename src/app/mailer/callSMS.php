<?php
    namespace messager;
    require_once("twilio-php/messager/message.php");
   
    class sender{

        public static function sendSMS($numero,$message){
            sender($numero,$message);
        }
        public static function sendMail($email,$message){
            
        }
    }
?>