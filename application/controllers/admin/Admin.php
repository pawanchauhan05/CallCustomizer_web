<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Controller to control all data flow
 */
class Admin extends CI_Controller {
    
    /**
     * to load index page
     */
    public function index() {
        $this->load->view('admin/index');
    }
 
    /**
     * to check admin exist or not
     */
    public function isAdminExist() {
        $userEmail = $this->input->post('email');
        $userPassword = $this->input->post('password');
        $data = $this->User->loginUserMobile($userEmail, md5($userPassword));
        //$data = $this->AdminModel->adminLogin($userEmail, md5($userPassword));
        if (isset($data)) {
            $this->AdminModel->startSession($data->name, $data->email);
            $this->index();
        }
    }

    /**
     * to logout admin
     */
    public function logout() {
        $this->AdminModel->stopSession();
        $this->index();
    }

    /**
     * to delete user
     */
    public function deleteUser() {
        $key = $this->uri->segment(3);
        $email = $this->AdminModel->decode($key);
        $this->AdminModel->deleteUser($email);
        $this->index();
    }

}
