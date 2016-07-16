<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PreLoginIndex extends CI_Controller {

	public function index()
	{
		$this->load->view('preLogin/index');
      $msg = 'My secret message';
      echo $encrypted_string = $this->encrypt->encode($msg);
      echo $this->encrypt->decode($encrypted_string);
	}

	public function registerUserMobile() { 

      $status = "";

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $json = file_get_contents('php://input');
         $user = (object)json_decode($json);
         $count = $this->User->isUserExist($user->email);
         if($count == 0) {
            $status = $this->User->registerUserMobile($user);
         } else {
            $status = "user already exist";
         }

         echo "{ ".'"status"'." : $status }";

      }

   }

   public function loginUserMobile() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $json = file_get_contents('php://input');
         $user = (object)json_decode($json);

         $count = $this->User->isUserExist($user->email);
         if($count == 1) {
            $row = $this->User->loginUserMobile($user->email, md5($user->password));
            header('Content-Type: application/json');
            echo json_encode($row);
         } else {
            echo " { ".'"email"'." : ".'"user does not exist"'." } ";
         } 

      }
   }


   public function registerTokenMobile() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $status = "";
         $json = file_get_contents('php://input');
         $token = (object)json_decode($json);
         $count = $this->User->isUserExist($token->email);
         if($count == 1) {
            if($this->Token->isUserExist($token->email) == 1) {
               $status = $this->Token->registerTokenMobile($token);
            } else {
               $status = '"token alrady exist"';
            }
            
         } else {
            $status = '"user does not exist"';
         }

         echo "{ ".'"status"'." : $status }";

      }
   }

   public function updateTokenMobile() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $status = "";
         $json = file_get_contents('php://input');
         $token = (object)json_decode($json);
         $count = $this->User->isUserExist($token->email);
         if($count == 1) {
            $status = $this->Token->updateTokenMobile($token);
         } else {
            $status = "user does not exist";
         }

         echo "{ ".'"status"'." : $status }";
      }
   }





}
