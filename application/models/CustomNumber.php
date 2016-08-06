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

         $status = $this->checkMobileNumberExist($customNumber->email, $customNumber->customNumber);

         if($status) {
            return '"false"';
         } else {
            if ($this->db->insert("CustomNumbers", $data)) { 
               $this->User->updateNumberStatusMobile($customNumber->email);
               return '"true"'; 
            } else {
               return '"false"';
            }
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

      public function deleteAllCustomNumberMobile($email) {
         $data = array (
            'email' => $email
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

      public function checkMobileNumberExist($userEmail, $customNumber) {
         $condition = "email =" . "'" . $userEmail . "' AND " . "customNumber =" . "'" . $customNumber . "'";
         $this->db->select('*');
         $this->db->from('CustomNumbers');
         $this->db->where($condition);
         $this->db->limit(1);
         $query = $this->db->get();
         $row = $query->row();
         if(isset($row)) {
            return true;
         } else {
            return false;
         }
      }

}