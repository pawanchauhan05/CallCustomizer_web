<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PreLoginIndex Controller Class to handle all user action while user is not logged in.
 */
class PreLoginIndex extends CI_Controller {

    public function index() {
        $this->load->view('preLogin/index');
        $msg = 'My secret message';
        echo $encrypted_string = $this->encrypt->encode($msg);
        echo $this->encrypt->decode($encrypted_string);
    }
    
    /**
     * to register user from mobile devices
     */
    public function registerUserMobile() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $user = (object) json_decode($json);
            $count = $this->User->isUserExist($user->email);
            if ($count == 0) {
                if($this->User->registerUserMobile($user)) {
                    $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(" { ".'"status"'." : ".'"User successfuly registered. Please login first."'." } ")
                    ->_display();
                    exit();
                } else {
                    $this->output
                    ->set_status_header(401)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(" { ".'"status"'." : ".'"Internal Server Error."'." } ")
                    ->_display();
                    exit();
                } 
            } else {
                $this->output
                        ->set_status_header(401)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(" { " . '"status"' . " : " . '"user already exist"' . " } ")
                        ->_display();
                exit();
            } 
        }
    }

    /**
     * to login user from mobile devices
     */
    public function loginUserMobile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $user = (object) json_decode($json);

            $count = $this->User->isUserExist($user->email);
            if ($count == 1) {
                $row = $this->User->loginUserMobile($user->email, md5($user->password));
                $this->output
                        ->set_status_header(200)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(json_encode($row))
                        ->_display();
                exit();
            } else {
                $this->output
                        ->set_status_header(401)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(" { " . '"status"' . " : " . '"user does not exist"' . " } ")
                        ->_display();
                exit();
            }
        }
    }

    /**
     * to register user token to send notification (mobile devices) 
     */
    public function registerTokenMobile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = "";
            $json = file_get_contents('php://input');
            $token = (object) json_decode($json);
            $count = $this->User->isUserExist($token->email);
            if ($count == 1) {
                if ($this->Token->isUserExist($token->email) == 1) {
                    $status = $this->Token->registerTokenMobile($token);
                } else {
                    $status = '"token alrady exist"';
                }
            } else {
                $status = '"user does not exist"';
            }

            echo "{ " . '"status"' . " : $status }";
        }
    }

    /**
     * to update user token to send notification (mobile devices)
     */
    public function updateTokenMobile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = "";
            $json = file_get_contents('php://input');
            $token = (object) json_decode($json);
            $count = $this->User->isUserExist($token->email);
            if ($count == 1) {
                $status = $this->Token->updateTokenMobile($token);
            } else {
                $status = '"user does not exist"';
            }

            echo "{ " . '"status"' . " : $status }";
        }
    }

}
