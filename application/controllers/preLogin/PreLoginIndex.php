<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PreLoginIndex extends CI_Controller {

	public function index()
	{
		$this->load->view('preLogin/index');
	}

	public function registerUserMobile() { 
			
         $data = array( 
            'name' => $this->input->post('roll_no'), 
            'email' => $this->input->post('name'),
            'password' => $this->input->post('name'),
            'loginType' => $this->input->post('name'),
            'created_at' => $this->input->post('name'),
            'updated_at' => $this->input->post('name')
         ); 
			
         $result = $this->User->registerUser($data); 
         if($result == true) {
         	echo "success";
         }
      }
}