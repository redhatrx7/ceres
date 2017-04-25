<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller
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
		
		$this->load->helper('form');
	}

	public function index()
	{
		$this->show_view('welcome_message');
	}

	public function data()
	{
		$response = array(
				'test' => 'this is a test'
		);

		$this->load->view('json', array('response' => $response));
	}

	public function get_user($id, $name=null)
	{
		$response = array(
				'get_user' => 'true'
		);

		$this->load->view('json', array('response' => $response));
	}

	public function post_user($id)
	{
		$request = $this->input->post();
		$response = array('success' => $request['theTest']);
		$this->load->view('json', array('response' => $response));
	}

	public function put_user($id)
	{
		$request = $this->input->put();
		$response = array('putsuccess' => $request['theTest']);
		$this->load->view('json', array('response' => $response));
	}

	public function delete_user()
	{
		$request = $this->input->delete();
		$response = array('deletesuccess' => $request['theTest']);
		$this->load->view('json', array('response' => $response));
	}
}
