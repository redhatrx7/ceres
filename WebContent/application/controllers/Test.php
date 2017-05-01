<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('form');
	}

	public function index()
	{
		$this->show_view('test');
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
