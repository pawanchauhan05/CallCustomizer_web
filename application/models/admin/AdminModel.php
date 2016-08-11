<?php

class AdminModel extends CI_Model {

	function __construct() { 
         parent::__construct(); 
    }

    public function loadView() {
    	$content = 'admin/dashboard';
    	$data = array();
    	if($this->uri->segment(2) != null) {
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

    public function startSession($name, $email) {
        $sessionArray = array(
                    'name' => $name,
                    'email' => $email,
                    'loggedIn' => TRUE
                    );
        $this->session->set_userdata('sessionData', $sessionArray);
    }

    public function stopSession() {
        $this->session->sess_destroy();
    }

    public function readSessionData() {
        return $sessionData = $this->session->all_userdata(); 
    }



}