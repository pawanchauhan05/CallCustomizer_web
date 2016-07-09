<?php

class User extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 

      public function registerUserMobile($data) { 
         if ($this->db->insert("user", $data)) { 
            return true; 
         } 
      } 

}