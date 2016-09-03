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
        $data = array(
            'uri' => '',
            'success' => '');
        $this->load->view('admin/index', $data);
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
    
    public function sendNotification() {
        $title = $this->input->post('title');
        $message = $this->input->post('message');
        $registrationToken = $this->input->post('token');
        //$registrationToken = "cVgqk4Vai1k:APA91bEtmZb-itiZGcBpnEnNeMroac2reE6_HytDjgzpRk4_3wkaUc1eEtV47QUrw0v3ei12DNsXUO6H80MGZ7P6nk-2337CVHhfSg0SS7pWPe67MqAGIu8KQSlKfaE-ykQR-UzHOYU0";
        $this->AdminModel->sendNotification($registrationToken, $message, $title);
    }

}
