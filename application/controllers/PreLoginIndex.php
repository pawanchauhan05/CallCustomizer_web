<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PreLoginIndex extends CI_Controller {

	public function index()
	{
		$this->load->view('preLogin/index');
	}
}