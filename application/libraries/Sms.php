<?php

class Sms{
    private $username = "mburumkrae";
    private $apikey = "7cb73f2717ba02d4f4d0a2157b6dc0c3d78a52545e0b3e6fbe2fb8c3073700b3";
    
    public function sendSms($recipients,$message){
        $gateway = new AfricasTalkingGateway($this->username, $this->apikey);
	// Any gateway errors will be captured by our custom Exception class below,
	// so wrap the call in a try-catch block
	try{
		// Thats it, hit send and we'll take care of the rest.
		$results = $gateway->sendMessage($recipients, $message);
		foreach($results as $result) {
                    $newSend= new SentMessages;
                    $newSend->number=$result->number;
                    $newSend->message_id=$result->messageId;
                    $newSend->status=$result->status;
                    $newSend->save();                    
			// Note that only the Status "Success" means the message was sent
			echo " Number: " .$result->number;
			echo " Status: " .$result->status;
			echo " MessageId: " .$result->messageId;
			echo " Cost: " .$result->cost."\n";
		}
	}
	catch ( AfricasTalkingGatewayException $e ){
            echo "Encountered an error while sending: ".$e->getMessage();
        }
    }
    
    
}
	// Be sure to include the file you've just downloaded
	require_once('AfricasTalkingGateway.php');
	// Specify your login credentials
	/*$username = "el_fasoh";
	$apikey = "761e6f1c741c5f4cce9fccfb23bf79fcc913f6ccb4347f77832120527d94422b";

	// Specify the numbers that you want to send to in a comma-separated list
	// Please ensure you include the country code (+254 for Kenya in this case)
	$recipients = "+254722373317,+254711300013";
	// And of course we want our recipients to know what we really do
	$message = "I'm a lumberjack and its ok, I sleep all night and I work all day, yea yea this is fasoh working on ussd n sms";
	// Create a new instance of our awesome gateway class
	$gateway = new AfricasTalkingGateway($username, $apikey);
	// Any gateway errors will be captured by our custom Exception class below,
	// so wrap the call in a try-catch block
	try{
		// Thats it, hit send and we'll take care of the rest.
		$results = $gateway->sendMessage($recipients, $message);
		foreach($results as $result) {
			// Note that only the Status "Success" means the message was sent
			echo " Number: " .$result->number;
			echo " Status: " .$result->status;
			echo " MessageId: " .$result->messageId;
			echo " Cost: " .$result->cost."\n";
		}
	}
	catch ( AfricasTalkingGatewayException $e ){
	echo "Encountered an error while sending: ".$e->getMessage();*/

?>