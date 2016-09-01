<?php

/**
 * User model to handle user action
 */
class User extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 

      /**
       * to register user mobile number
       * @param type $user  user data while registration
       * @return boolean    to notify data inserted or not
       */
      public function registerUserMobile($user) { 
         $data = array( 
            'created_at' => time(),
            'updated_at' => time(),
            'name' => $user->name,
            'email' => $user->email,
            'password' => md5($user->password),
            'loginType' => $user->loginType,
            'numberStatus' => 0
         );

         if ($this->db->insert("Users", $data)) { 
             return TRUE;
         } else {
             return FALSE;
         }
      } 

      /**
       * to check user email exist or not
       * @param type $userEmail user email
       * @return type   number of rows in database
       */
      public function isUserExist($userEmail) {
      		$query = $this->db->query("SELECT * FROM Users WHERE email = '$userEmail' ");
      		return $query->num_rows();
      }

      /**
       * to login user from mobile devices
       * @param type $userEmail user email
       * @param type $userPassword  user password
       * @return type
       */
      public function loginUserMobile($userEmail, $userPassword) {
      	$condition = "email =" . "'" . $userEmail . "' AND " . "password =" . "'" . $userPassword . "'";
      	$this->db->select('*');
  			$this->db->from('Users');
  			$this->db->where($condition);
  			$this->db->limit(1);
  			$query = $this->db->get();
  			$row = $query->row();
         if(isset($row)) {
            return $query->row();
         } else {
            $this->output
                    ->set_status_header(401)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(" { ".'"status"'." : ".'"invalid credentials"'." } ")
                    ->_display();
                    exit();
         }
      }
      
      /**
       * to update mobile number status i.e user added any custom number in DB or not
       * @param type $email
       */
      public function updateNumberStatusMobile($email) {
         $data = array( 
            'numberStatus' => 1
         ); 
         $this->db->set($data); 
         $this->db->where("email", $email); 
         $this->db->update("Users", $data);
      }

}