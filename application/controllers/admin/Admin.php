<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function index() {
		$this->load->view('admin/index');
	}

	public function isAdminExist() {
        $userEmail = $this->input->post('email');
        $userPassword = $this->input->post('password');
        $data = $this->User->loginUserMobile($userEmail, md5($userPassword));
        if(isset($data)) {
        	$this->AdminModel->startSession($data->name, $data->email);
        	$this->index();
        }
    }

    public function logout() {
    	$this->AdminModel->stopSession();
    	$this->index();
    }

}