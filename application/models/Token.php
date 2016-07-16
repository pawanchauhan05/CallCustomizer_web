<?php

class Token extends CI_Model {

	function __construct() {
		parent::__construct(); 
	}
	
	public function registerTokenMobile($token) {
		$data = array(
				'updated_at' => time(),
				'email' => $token->email,
				'token' => $token->token
			);
		if ($this->db->insert("Tokens", $data)) { 
            return '"true"'; 
         } else {
         	return '"false"';
         }
	}

	public function updateTokenMobile($token) {
		$data = array( 
            'token' => $token->token,
            'updated_at' => time()
         ); 

		$this->db->set($data); 
	    $this->db->where("email", $token->email); 
	    if($this->db->update("Tokens", $data)) {
	    	return '"true"';
	    } else {
	    	return '"false"';
	    }

	}

	public function isUserExist($userEmail) {
      		$query = $this->db->query("SELECT * FROM Tokens WHERE email = '$userEmail' ");
      		return $query->num_rows();
      }


}