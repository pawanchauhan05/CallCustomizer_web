<?php

/**
 * CustomNumber Model to handle action related to mobile numbers
 */
class CustomNumber extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * to add custom mobile number from mobile devices
     * @param type $customNumber    custom mobile number
     * @return string   result based on number added or not in DB
     */
    public function addCustomNumberMobile($customNumber) {
        $data = array(
            'created_at' => time(),
            'updated_at' => time(),
            'email' => $customNumber->email,
            'name' => $customNumber->name,
            'customNumber' => $customNumber->customNumber
        );

        $status = $this->checkMobileNumberExist($customNumber->email, $customNumber->customNumber);

        if ($status) {
            return '"false"';
        } else {
            if ($this->db->insert("CustomNumbers", $data)) {
                $this->User->updateNumberStatusMobile($customNumber->email);
                return '"true"';
            } else {
                return '"false"';
            }
        }
    }

    /**
     * to delete custom mobile number from mobile devices
     * @param type $customNumber    custom mobile number
     * @return string   result based on number added or not in DB
     */
    public function deleteCustomNumberMobile($customNumber) {
        $data = array(
            'name' => $customNumber->name,
            'customNumber' => $customNumber->customNumber,
            'email' => $customNumber->email
        );

        $this->db->where($data);
        if ($this->db->delete("CustomNumbers")) {
            return '"true"';
        } else {
            return '"false"';
        }
    }

    /**
     * to delete all custom mobile number from mobile devices
     * @param type $email   user email address
     * @return string   result based on i.e numtber is deleted or not
     */
    public function deleteAllCustomNumberMobile($email) {
        $data = array(
            'email' => $email
        );
        $this->db->where($data);
        if ($this->db->delete("CustomNumbers")) {
            return '"true"';
        } else {
            return '"false"';
        }
    }

    /**
     * to update custom mobile number from mobile devices
     * @param type $customNumber    custom mobile number
     * @return string   result based on number is updated or not
     */
    public function updateCustomNumberMobile($customNumber) {
        $data = array(
            'name' => $customNumber->name,
            'customNumber' => $customNumber->customNumber
        );

        $this->db->set($data);
        $this->db->where("email", $customNumber->email);
        if ($this->db->update("CustomNumbers", $data)) {
            return '"true"';
        } else {
            return '"false"';
        }
    }

    /**
     * to get custom mobile number from mobile devices
     * @param type $userEmail user email address
     * @return type custom mobile number list
     */
    public function getCustomNumberMobile($userEmail) {
        $query = $this->db->query("SELECT * FROM CustomNumbers WHERE email = '$userEmail' ");
        return $query->result();
    }

    /**
     * to check mobile number exist or not from mobile devices
     * @param type $userEmail   user email address
     * @param type $customNumber    custom mobile number
     * @return boolean  status based on number exist or not
     */
    public function checkMobileNumberExist($userEmail, $customNumber) {
        $condition = "email =" . "'" . $userEmail . "' AND " . "customNumber =" . "'" . $customNumber . "'";
        $this->db->select('*');
        $this->db->from('CustomNumbers');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * to check user email exist or not
     * @param type $userEmail   user email address
     * @return type number of rows in database
     */
    public function isUserExist($userEmail) {
        $query = $this->db->query("SELECT * FROM CustomNumbers WHERE email = '$userEmail' ");
        return $query->num_rows();
    }

}
