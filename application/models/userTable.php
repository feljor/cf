<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserTable extends CI_Model {

    public $session_id='';
    public $session_menu='';
    public $session_pg= 0 ;
    public $session_tel='';
    public $sesssion_others='';
    private $table = 'user';
    
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//---------------------------------------------------------------------------------------------------------------------
    /**
     * User CRUD Methods
     */
    #Search for Subsctibed users using telephone no.
    public function get_user_telephone_number($telephone_no)
    {
        $query = $this->db->get_where('user', array('telephone_no' => $telephone_no), $limit, $offset);
        foreach ($query->result() as $row) {
            return $row->telephone_no;
        }
    }

    #User Subscribes
    public function insert_user($fname, $lname, $telephone_no, $location)
    {
        
        $data = array(
          'fname' => $fname,
          'lname' => $lname,
          'telephone_no' => $telephone_no,
          'location' => $location
        );
        $this->db->insert($this->table, $data);
    }
    
    #User updates Information
    public function update_user($id, $fname, $lname, $telephone_no, $location)
    {
        $data = array(
          'fname' => $fname,
          'lname' => $lname,
          'telephone_no' => $telephone_no,
          'location' => $location
        );
        
        $this->db->update($this->table, $data)->where('user_id',$id);
    }
    
    #When a user unsubscribe themselves from services
    public function unSubscribe($id,$telephone_no){
        $data = array(
            'user_id' => $id,
            'status' => '0'
        );
        
        $this->db->update($this->table, $data )->where(array('user_id',$id), 'telephone_no', $telephone_no);
    }
    
//-------------------------------------------------------------------------------------------------------------------------------------    
    /**
     * Tracking user during USSD Session
     */
    
    #Setting the session
    public function setSession($session_id, $telephone_no, $menu, $pg){
        
        $sessions = array(
            'session_id' => $session_id,
            'tel' => $telephone_no,
            'menu' => $menu,
            'pg' => $pg
        );
        $this->db->insert('sessions', $sessions );
    }
    
    #Retrieving sessions and putting them into an array
    public function getSession($telephone_no){
        
        $this->telephone_no = $telephone_no;
        
        $this->db->select('*')->where('telephone_no', $telephone_no);
    }

    public function saveSession(){}
    
}