<?php

class AdminModel extends CI_Model {

	function __construct() { 
         parent::__construct(); 
    }

    public function loadView() {
    	$content = 'admin/dashboard';
    	if($this->uri->segment(2) != null) {
			switch ($this->uri->segment(2)) {
				case 'users':
					$content = 'admin/dashboard';
					break;
				
				default:
					$content = 'admin/dashboard';
					break;
			}
		}
    	$this->load->view($content);

    }

}