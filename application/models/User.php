<?php

class User extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 

      public function registerUserMobile($user) { 
         $data = array( 
            'created_at' => time(),
            'updated_at' => time(),
            'name' => $user->name,
            'email' => $user->email,
            'password' => md5($user->password),
            'loginType' => $user->loginType
         );

         if ($this->db->insert("Users", $data)) { 
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