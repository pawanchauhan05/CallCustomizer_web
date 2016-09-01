<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home Controller Class to handle user action while user is logged in.
 */
class Home extends CI_Controller {

    /**
     * to add user custom mobile number from mobile devices
     */
    public function addCustomNumberMobile() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $customNumber = (object) json_decode($json);

            $count = $this->User->isUserExist($customNumber->email);
            if ($count == 1) {
                $status = $this->CustomNumber->addCustomNumberMobile($customNumber);
            } else {
                $status = "user does not exist";
            }

            echo "{ " . '"status"' . " : $status }";
        }
    }

    /**
     * to delete user custom mobile number from mobile devices
     */
    public function deleteCustomNumberMobile() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $customNumber = (object) json_decode($json);

            $count = $this->User->isUserExist($customNumber->email);
            if ($count == 1) {
                $status = $this->CustomNumber->deleteCustomNumberMobile($customNumber);
            } else {
                $status = "user does not exist";
            }

            echo "{ " . '"status"' . " : $status }";
        }
    }

    /**
     * to update user custom mobile number from mobile devices
     */
    public function updateCustomNumberMobile() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $customNumber = (object) json_decode($json);

            $count = $this->User->isUserExist($customNumber->email);
            if ($count == 1) {
                $status = $this->CustomNumber->updateCustomNumberMobile($customNumber);
            } else {
                $status = "user does not exist";
            }

            echo "{ " . '"status"' . " : $status }";
        }
    }

    /**
     * to get user custom mobile number from mobile devices
     */
    public function getCustomNumberMobile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $data = (object) json_decode($json);

            $count = $this->User->isUserExist($data->email);
            if ($count == 1) {
                $row = $this->CustomNumber->getCustomNumberMobile($data->email);
                if (isset($row)) {
                    echo json_encode($row);
                }
            } else {
                $status = "user does not exist";
            }

            //echo "{ 'status' : '$status' }";
        }
    }

    /**
     * to sync user db to server db from mobile devices to server 
     */
    public function syncDataFromMobile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $status = '"sync"';
            $data = (Array) json_decode($json);
            $this->CustomNumber->deleteAllCustomNumberMobile($data[0]->email);
            foreach ($data as $key => $value) {
                $this->CustomNumber->addCustomNumberMobile($value);
            }
            echo "{ " . '"status"' . " : $status }";
        }
    }

}
