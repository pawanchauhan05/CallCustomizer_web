<?php

class CustomNumber extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 

      public function addCustomNumberMobile($customNumber) {
         $data = array( 
            'created_at' => time(),
            'updated_at' => time(),
            'email' => $customNumber->email,
            'name' => $customNumber->name,
            'customNumber' => $customNumber->customNumber
         );
      	if ($this->db->insert("CustomNumbers", $data)) { 
            return '"true"'; 
         } else {
         	return '"false"';
         }

      }

      public function deleteCustomNumberMobile($customNumber) {
      	$data = array( 
            'name' => $customNumber->name,
            'customNumber' => $customNumber->customNumber,
            'email' => $customNumber->email
         );

      	$this->db->where($data);
      	if($this->db->delete("CustomNumbers")) {
      		return '"true"';
      	} else {
      		return '"false"';
      	}
      }

      public function updateCustomNumberMobile($customNumber) {
      	$data = array( 
            'name' => $customNumber->name,
            'customNumber' => $customNumber->customNumber
         ); 

      	$this->db->set($data); 
         $this->db->where("email", $customNumber->email); 
         if($this->db->update("CustomNumbers", $data)) {
          	return '"true"';
         } else {
          	return '"false"';
         }
      }

      public function getCustomNumberMobile($userEmail) {
      	$query = $this->db->query("SELECT * FROM CustomNumbers WHERE email = '$userEmail' ");
      	return $query->result();

      }

}