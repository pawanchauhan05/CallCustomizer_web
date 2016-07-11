<?php

class User extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 

      public function registerUserMobile($user) { 
         if ($this->db->insert("Users", $user)) { 
            return "true"; 
         } else {
         	return "false";
         }
      } 

      public function isUserExist($userEmail) {
      		$query = $this->db->query("SELECT * FROM Users WHERE email = '$userEmail' ");
      		return $query->num_rows();
      }

      public function loginUserMobile($userEmail, $userPassword) {

	      	$condition = "email =" . "'" . $userEmail . "' AND " . "password =" . "'" . $userPassword . "'";
	      	$this->db->select('*');
			$this->db->from('Users');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			return $query->row();

      }

}