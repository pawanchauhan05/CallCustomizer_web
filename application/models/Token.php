<?php

/**
 * Token Model to handle action related to user tokens
 */
class Token extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * to register user token from mobile devices
     * @param type $token   user token
     * @return string   result based on token added in DB or not
     */
    public function registerTokenMobile($token) {
        $data = array(
            'updated_at' => time(),
            'email' => $token->email,
            'token' => $token->token
        );
        if ($this->db->insert("Tokens", $data)) {
            return '"true"';
        } else {
            return '"false"';
        }
    }

    /**
     * to update user token from mobile devices
     * @param type $token   user token
     * @return string   result based on token added in DB or not
     */
    public function updateTokenMobile($token) {
        $data = array(
            'token' => $token->token,
            'updated_at' => time()
        );

        $this->db->set($data);
        $this->db->where("email", $token->email);
        if ($this->db->update("Tokens", $data)) {
            return '"true"';
        } else {
            return '"false"';
        }
    }

    /**
     * to check user exist or not
     * @param type $userEmail   user email address
     * @return type number of rows in DB
     */
    public function isUserExist($userEmail) {
        $query = $this->db->query("SELECT * FROM Tokens WHERE email = '$userEmail' ");
        return $query->num_rows();
    }
    
    
    public function getToken($email) {
        $this->db->select('token');
        $this->db->from('Tokens');
        $this->db->where("email", $email);
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            return $query->row();
        }
    }

}
