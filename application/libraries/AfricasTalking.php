<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class AfricasTalking {
       
        public function Africa_Talkings() {
            require_once('AfricasTalkingGateway.php');
            require_once('Sms.php');
        }
   }
?>
