<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function addCustomNumberMobile() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $json = file_get_contents('php://input');
         $customNumber = (object)json_decode($json);

         $count = $this->User->isUserExist($customNumber->email);
         if($count == 1) {
            $status = $this->CustomNumber->addCustomNumberMobile($customNumber);
         } else {
            $status = "user does not exist";
         }

         echo "{ 'status' : '$status' }";

      }
	}

	public function deleteCustomNumberMobile() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $json = file_get_contents('php://input');
         $customNumber = (object)json_decode($json);

         $count = $this->User->isUserExist($customNumber->email);
         if($count == 1) {
            $status = $this->CustomNumber->deleteCustomNumberMobile($customNumber);
         } else {
            $status = "user does not exist";
         }

         echo "{ 'status' : '$status' }";

      }
	}

	public function updateCustomNumberMobile() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $json = file_get_contents('php://input');
         $customNumber = (object)json_decode($json);

         $count = $this->User->isUserExist($customNumber->email);
         if($count == 1) {
            $status = $this->CustomNumber->updateCustomNumberMobile($customNumber);
         } else {
            $status = "user does not exist";
         }

         echo "{ 'status' : '$status' }";

      }
	}


	public function getCustomNumberMobile() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $json = file_get_contents('php://input');
         $data = (object)json_decode($json);

         $count = $this->User->isUserExist($data->email);
         if($count == 1) {
            $row = $this->CustomNumber->getCustomNumberMobile($data->email);
            $status =  json_encode($row);
         } else {
            $status = "user does not exist";
         }

         echo "{ 'status' : '$status' }";

      }
	}

}