<?php

/**
 * User model to handle user action
 */
class User extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function generatePassword($length, $type = '') {
        // Select which type of characters you want in your random string
        switch ($type) {
            case 'num':
                // Use only numbers
                $salt = '1234567890';
                break;
            case 'lower':
                // Use only lowercase letters
                $salt = 'abcdefghijklmnopqrstuvwxyz';
                break;
            case 'upper':
                // Use only uppercase letters
                $salt = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            default:
                // Use uppercase, lowercase, numbers, and symbols
                $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                break;
        }
        $rand = '';
        $i = 0;
        while ($i < $length) { // Loop until you have met the length
            $num = rand() % strlen($salt);
            $tmp = substr($salt, $num, 1);
            $rand = $rand . $tmp;
            $i++;
        }
        return $rand; // Return the random string
    }

    /**
     * to register user from mobile devices
     * @param type $user  user data while registration
     * @return boolean    to notify data inserted or not
     */
    public function registerUserMobile($user) {
        $data = array(
            'created_at' => time(),
            'updated_at' => time(),
            'name' => $user->name,
            'email' => $user->email,
            'password' => md5($user->password),
            'loginType' => $user->loginType,
            'numberStatus' => 0
        );

        if ($this->db->insert("Users", $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * to register facebook user from mobile devices
     * @param type $user  user data while registration
     * @return boolean    to notify data inserted or not
     */
    public function facebookRegisterUserMobile($user) {
        $password = $this->generatePassword(10, $type = '');
        $data = array(
            'created_at' => time(),
            'updated_at' => time(),
            'name' => $user->name,
            'email' => $user->email,
            'password' => md5($password),
            'loginType' => $user->loginType,
            'numberStatus' => 0
        );

        if ($this->db->insert("Users", $data)) {
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'pawanetm@gmail.com',
                'smtp_pass' => 'ourlab.tk'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('pawanetm@gmail.com', 'Pawan Singh Chauhan');
            $this->email->to($user->email);
            $this->email->subject('Email Test');
            $this->email->message($password);
            $this->email->send();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * to check user email exist or not
     * @param type $userEmail user email
     * @return type   number of rows in database
     */
    public function isUserExist($userEmail) {
        $query = $this->db->query("SELECT * FROM Users WHERE email = '$userEmail' ");
        return $query->num_rows();
    }

    /**
     * to login user from mobile devices
     * @param type $userEmail user email
     * @param type $userPassword  user password
     * @return type
     */
    public function loginUserMobile($userEmail, $userPassword) {
        $condition = "email =" . "'" . $userEmail . "' AND " . "password =" . "'" . $userPassword . "'";
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            return $query->row();
        } else {
            $this->output
                    ->set_status_header(401)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(" { " . '"status"' . " : " . '"invalid credentials"' . " } ")
                    ->_display();
            exit();
        }
    }

    /**
     * to update mobile number status i.e user added any custom number in DB or not
     * @param type $email
     */
    public function updateNumberStatusMobile($email) {
        $data = array(
            'numberStatus' => 1
        );
        $this->db->set($data);
        $this->db->where("email", $email);
        $this->db->update("Users", $data);
    }

}
