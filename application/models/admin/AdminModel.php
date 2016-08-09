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

				
				default:
					$content = 'admin/dashboard';
					break;
			}
		}
    	$this->load->view($content);

    }

    public function userDetails() {
    	$query = $this->db->query("SELECT * FROM Users");
      	return $query->result();
    }

    public function customNumberDetails() {
    	$query = $this->db->query("SELECT * FROM CustomNumbers");
      	return $query->result();
    }

}