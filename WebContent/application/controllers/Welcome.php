<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->helper('form');
	}

	public function index()
	{
		print_r($this->input->get('username'));
		print_r($this->input->post('username'));
		$results = $this->user->get_users();
		$this->show_view('welcome_message', array('results' => $results));
	}
}
