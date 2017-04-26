<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('form');
	}

	public function index()
	{
		$this->show_view('login');
	}
}
