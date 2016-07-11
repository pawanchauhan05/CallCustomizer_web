<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PreLoginIndex extends CI_Controller {

	public function index()
	{
		$this->load->view('preLogin/index');
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
            $status = "user exist";
         }

         echo "{ 'status' : '$status' }";

      }

   }

   public function loginUserMobile() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $json = file_get_contents('php://input');
         $user = (object)json_decode($json);

         $count = $this->User->isUserExist($user->email);
         if($count == 1) {
            $row = $this->User->loginUserMobile($user->email, $user->password);
            echo json_encode($row);
         } else {
            echo $status = "user does not exist";
         } 

      }
   }


   public function registerTokenMobile() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $json = file_get_contents('php://input');
         $token = (object)json_decode($json);
         $count = $this->User->isUserExist($token->email);
         if($count == 1) {
            $status = $this->Token->registerTokenMobile($token);
         } else {
            $status = "user exist";
         }

      }
   }

   public function updateTokenMobile() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $json = file_get_contents('php://input');
         $token = (object)json_decode($json);
         $count = $this->User->isUserExist($token->email);
         if($count == 1) {
            $status = $this->Token->updateTokenMobile($token);
         } else {
            $status = "user does not exist";
         }

         echo "{ 'status' : '$status' }";
      }
   }





}
