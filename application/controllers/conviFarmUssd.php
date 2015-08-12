<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConviFarmUssd extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('AfricasTalking');
        $this->load->model('UserTable');
      
    }
    public function index() {
         
         $result = $this->getLevel($text);
         $level = $result['level'];
         $message = $result['latest_message'];
         switch (strtolower($level)){
             case 0:
                $response = $this->getHomeMenu();
                 break;
             case 1:
                 $response = $this->getLevelOneMenu($message);
                 break;
             case 2:
                 $response = $this->getLevelOneMenu($message);
                 break;
             default:
                 $response = $this->getHomeMenu();
                 break;
         }
         sendOutput($response, 1);
         exit;
         $exploded_text = explode('*', $text);
         print_r($exploded_text);
         
         
        //LEVEL 1
        $input = getInput();
         
	if($input['text'] == "" ){
	//this is the first request
	    
		$this->getHomeMenu();
                $this->sendOutput($response, 1);
	}  else {
            switch (strtolower($input['text'])){
                case 1:
                    //English Version
                    //check if user already exits
                    $tel_no  = $this->UserTable->get_user_telephone_no($phonenumber);
                    if($tel_no == '1'){
                       $this->getLevelOneMenuEnglish();
                    }
                    
                    //if no user detected proceed to registration process
                    if ($tel_no < 1 && $tel_no == '0') {
                        $this->registration();
                    }                        
                        if($tel_no == '1'){
                        $this->getLevelOneMenuEnglish();
                        }
                    
                    break;
                case 2:
                    //Kiswahili Version
                    $tel_no  = $this->UserTable->get_user_telephone_no($phonenumber);
                    if($tel_no == '1'){
                        $this->getLevelOneMenuKiswahili();
                    }
                    if ($tel_no < 1 && $tel_no == '0') {
                        $this->registrationKiswahili();
                    }                        
                        if($tel_no == '1'){
                        $this->getLevelOneMenuKiswahili();
                        }
                    break;
                default:
                    $response = "Please try again later/Tafadhali jaribu badaaye ";
                    break;
            }
        }
 
    }
    
//----------------------------------------------------------------------------------------------------------------------------------

    //getting application level
    public function getLevel($text){
        if($text == ""){
          $response['level'] = 0;
        }else{
          $exploded_text = explode('*',$text);
          $response['level'] = count($exploded_text);
          $response['latest_message'] = end($exploded_text);
        }
        return $response;
      }
      
//----------------------------------------------------------------------------------------------------------------------------------
      
      public function registrationEnglish($fname, $lname, $location, $tel_no){
                        
                        $response .="CON Welcome to KilimoRahisi Tool. Kindly register to use this tool".PHP_EOL;
                        $response .="Enter your First Name";
                            if($text == $fname) {
                                $response .="Enter your Second Name";
                            }
                                if($text == $lname){
                                    $response .= "Enter your phonenumber";
                                }
                                    if($text == $phonenumber){
                                       $response .="Enter your location";
                                    }
                            else{    
                                $response .="Kindly try again later";
                            }
                            
                        $newUser = $this->UserTable->insert_user();
                        $this->sendOutput($response, 1);

      }
      public function registrationKiswahili($input){
                        
                        $response .="CON Karibu KilimoRahisi. Tafadhali jiandikishe katika huduma yetu".PHP_EOL;
                        $response .="Jina lako la kwanza";
                            if($text == $fname) {
                                $response .="Jina lako la pili";
                            }
                                if($text == $lname){
                                    $response .= "Nambari ya simu";
                                }
                                    if($text == $phonenumber){
                                       $response .="Kaunti yako";
                                    }
                            else{    
                                $response .="Pole. Jaribu tena badaaye";
                            }
                            
                        $newUser = $this->UserTable->insert_user();
                        $this->sendOutput($response, 1);
      }

//----------------------------------------------------------------------------------------------------------------------------------
      //Home Level 0
      public function getHomeMenu() {
            $response ="CON Select a language".PHP_EOL;
            $response .= "1. English".PHP_EOL;
            $response .= "2. Kiswahili";
            $this->sendOutput($response, 1);
      }
      
//----------------------------------------------------------------------------------------------------------------------------------
      //Level 1
      public function getLevelOneMenuEnglish(){
            $response .=" Select an enterprise".PHP_EOL;
            $response .=" 1. Crop Farming".PHP_EOL;
            $response .=" 2. Bee Farming".PHP_EOL;
            $response .=" 3. Soil Testing Services".PHP_EOL;
            $response .=" 4. Poultry Farming".PHP_EOL;
            $response .=" 5. Access a vet";
            $this->sendOutput($response, 1);
      }
      public function getLevelOneMenuKiswahili() {
            $response ="CON Chagua Ukulima ".PHP_EOL;
            $response .=" 1. Ukulima wa mimea".PHP_EOL;
            $response .=" 2. Ukulima wa nyuki".PHP_EOL;
            $response .=" 3. Soil Testing Services".PHP_EOL;
            $response .=" 4. Ukulima wa kuku".PHP_EOL;
            $response .=" 5. Ita Daktari wa wanyama";
            $this->sendOutput($response, 1);
      }

//----------------------------------------------------------------------------------------------------------------------------------
      //Level 2
      public function getLevelTwoEnglish(){
            $response .=" Select a crop".PHP_EOL;
            $response .=" 1. Peas".PHP_EOL;
            $response .=" 2. Beans".PHP_EOL;
            $response .=" 3. Tomaotes".PHP_EOL;
            $response .=" 4. Potatoes".PHP_EOL;
            $response .=" 5. Coffee".PHP_EOL;
            $response .=" 5. Cucumber".PHP_EOL;
            $response .=" 5. Sweet Pepper".PHP_EOL;
            $this->sendOutput($response, 1);
      }
      public function getLevelTwoKiswahili(){
          
      }
//----------------------------------------------------------------------------------------------------------------------------------
      //Level 3
      public function getLevelThreeEnglish(){
            $response .=" Select".PHP_EOL;
            $response .=" 1. Spray Program".PHP_EOL;
            $response .=" 2. Seed Information".PHP_EOL;
            $response .=" 3. Growing Information".PHP_EOL;
            $response .=" 4. Sell Your Produce".PHP_EOL;
            $this->sendOutput($response, 1);
      }
      public function getLevelThreeKiswahili(){
          
      }
//----------------------------------------------------------------------------------------------------------------------------------
      //Level 4
        #PEAS
        public function getLevelFourEnglishPeas(){
            $response .=" Select crop stage".PHP_EOL;
            $response .=" 1. Early Season".PHP_EOL;
            $response .=" 2. Vegetative".PHP_EOL;
            $response .=" 3. Flowering".PHP_EOL;
            $response .=" 4. Podding".PHP_EOL;
            
        }
        public function getLevelFourKiswahiliPeas(){

        }
        
        #BEANS
        public function getLevelFourEnglishBeans(){
            $response .=" Select crop stage".PHP_EOL;
            $response .=" 1. Early Season".PHP_EOL;
            $response .=" 2. Vegetative".PHP_EOL;
            $response .=" 3. Flowering".PHP_EOL;
            $response .=" 4. Harvesting".PHP_EOL;
            
        }
        
        public function getLevelFourKiswahiliBeans(){
          
        }
        
        #TOMATOES
        public function getLevelFourEnglishTomatoes(){
            $response .=" Select crop stage".PHP_EOL;
            $response .=" 1. Nursery".PHP_EOL;
            $response .=" 2. Vegetative".PHP_EOL;
            $response .=" 3. Transplanting".PHP_EOL;
            $response .=" 4. Flowering".PHP_EOL;
            $response .=" 5. Fruting".PHP_EOL;
            
        }
        
        public function getLevelFourKiswahiliTomatoes(){
          
        }
        
        #POTATOES
        public function getLevelFourEnglishPotatoes(){
            $response .=" Select crop stage".PHP_EOL;
            $response .=" 1. Nursery".PHP_EOL;
            $response .=" 2. Vegetative".PHP_EOL;
            $response .=" 3. Flowering".PHP_EOL;
            $response .=" 4. Pre-harvesting".PHP_EOL;
            
        }
        
        public function getLevelFourKiswahiliPotatoes(){
          
        }
        
        #COFFEE
        public function getLevelFourEnglishCoffee(){
            $response .=" Select crop stage".PHP_EOL;
            $response .=" 1. Early Season".PHP_EOL;
            //$response .=" 2. Vegetative".PHP_EOL;
            //$response .=" 3. Flowering".PHP_EOL;
            //$response .=" 4. Podding".PHP_EOL;
            
        }
        
        public function getLevelFourKiswahiliCoffee(){
          
        }
        
        #CUCUMBER
        public function getLevelFourEnglishCucumber(){
            $response .=" Select crop stage".PHP_EOL;
            $response .=" 1. Nursery".PHP_EOL;
            $response .=" 2. Flowering".PHP_EOL;
            $response .=" 3. Transplanting".PHP_EOL;
            $response .=" 4. Harvesting".PHP_EOL;
            
        }
        
        public function getLevelFourKiswahiliCucumber(){
          
        }
        
        #SWEET PEPPER
        public function getLevelFourEnglishSweetPepper(){
            $response .=" Select crop stage".PHP_EOL;
            $response .=" 1. Nursery".PHP_EOL;
            $response .=" 2. Vegetative".PHP_EOL;
            $response .=" 3. Flowering".PHP_EOL;
            $response .=" 4. Fruiting".PHP_EOL;
            $response .=" 4. Harvesting".PHP_EOL;
            
        }
        public function getLevelFourKiswahiliSweetPepper(){
          
        }
//----------------------------------------------------------------------------------------------------------------------------------
      //Level 5
      public function getLevelFiveEnglish(){
          
      }
      public function getLevelFiveKiswahili(){
          
      }
//----------------------------------------------------------------------------------------------------------------------------------

    public function getInput(){
        $input = array();
        $input['sessionId']   = $_GET["sessionId"];
        $input['serviceCode'] = $_GET["serviceCode"];
        $input['phoneNumber'] = $_GET["phoneNumber"];
        $input['text'] = $_GET["text"];
        $input['fname'] = $_GET["fname"];
        $input['lname'] = $_GET["lname"];
        $input['location'] = $_GET["location"];
        
        $text = $input['text'];
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);
        
        return $input;
    }
    
    public function sendOutput($message,$type=2){
	//Type 1 is a continuation, type 2 output is an end
	if($type==1){
		echo "CON ".$message;
	}elseif($type==2){
		echo "END ".$message;
	}else{
		echo "END We faced an error";
	}
	exit;
    }

}