<?php

/**
 * AdminModel to handle admin action
 */
class AdminModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * to load view while user click on link
     */
    public function loadView() {
        $content = 'admin/dashboard';
        $data = array();
        if ($this->uri->segment(2) != null) {
            switch ($this->uri->segment(2)) {
                case 'users':
                    $content = 'admin/Users';
                    break;

                case 'CustomNumbers':
                    $content = 'admin/CustomNumbers';
                    break;

                case 'Tokens':
                    $content = 'admin/tokens';
                    break;


                default:
                    $content = 'admin/dashboard';
                    break;
            }
        }
        $this->load->view($content);
    }

    // TODO create common function for userDetails, customNumberDetails, tokenDetails
    public function userDetails() {
        $query = $this->db->query("SELECT * FROM Users");
        return $query->result();
    }

    public function customNumberDetails() {
        $query = $this->db->query("SELECT * FROM CustomNumbers");
        return $query->result();
    }

    public function tokenDetails() {
        $query = $this->db->query("SELECT * FROM Tokens");
        return $query->result();
    }
    
    /**
     * to start session of admin
     * @param type $name    admin name
     * @param type $email   admin email address
     */
    public function startSession($name, $email) {
        $sessionArray = array(
            'name' => $name,
            'email' => $email,
            'loggedIn' => TRUE
        );
        $this->session->set_userdata('sessionData', $sessionArray);
    }

    /**
     * to stop session of admin
     */
    public function stopSession() {
        $this->session->sess_destroy();
    }

    /**
     * to read session data
     * @return type session data
     */
    public function readSessionData() {
        return $sessionData = $this->session->all_userdata();
    }
    
    /**
     * to total count number of records in table
     * @param type $tableName   table name
     * @return type total no. of records
     */
    public function totalCount($tableName) {
        $this->db->from($tableName);
        $query = $this->db->get();
        return $rowcount = $query->num_rows();
    }

    /**
     * to delete user
     * @param type $email   user email address
     */
    public function deleteUser($email) {
        $data = array(
            'email' => $email
        );
        $this->db->where($data);
        $count = $this->User->isUserExist($email);
        if ($count > 0) {
            $this->db->delete("Users");
        }
        $count = $this->CustomNumber->isUserExist($email);
        if ($count > 0) {
            $this->db->delete("CustomNumbers");
        }
        $count = $this->Token->isUserExist($email);
        if ($count > 0) {
            $this->db->delete("Tokens");
        }
    }

    /**
     * to admin login
     * @param type $userEmail   admin email address
     * @param type $userPassword    admin password
     * @return type status based on result
     */
    public function adminLogin($userEmail, $userPassword) {
        $condition = "email =" . "'" . $userEmail . "' AND " . "password =" . "'" . $userPassword . "'";
        $this->db->select('*');
        $this->db->from('Admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            return $query->row();
        } else {
            return " { " . '"status"' . " : " . '"invalid credentials"' . " } ";
        }
    }

    /*     * *************************** For Encryption only ******************************************* */

    var $skey = "SuPerEncRKey2016";

    public function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function encode($value) {

        if (!$value) {
            return false;
        }
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext));
    }

    public function decode($value) {

        if (!$value) {
            return false;
        }
        $crypttext = $this->safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }

}
