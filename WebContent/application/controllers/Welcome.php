<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('user');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}

	public function index()
	{
		$session = $this->session->userdata();
		$this->show_view('welcome_message', array('session' => $session['user']));
	}
}
