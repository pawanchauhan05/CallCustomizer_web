<?php

class Token extends CI_Model {

	function __construct() {
		parent::__construct(); 
	}
	
	public function registerTokenMobile($token) {
		if ($this->db->insert("Tokens", $token)) { 
            return "true"; 
         } else {
         	return "false";
         }
	}

	public function updateTokenMobile($token) {
		$data = array( 
            'token' => $token->token
         ); 

		$this->db->set($data); 
	    $this->db->where("email", $token->email); 
	    if($this->db->update("Tokens", $data)) {
	    	return "true";
	    } else {
	    	return "false";
	    }

	}


}