<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tests for the Test class
 * 
 * @package ceres
 * @author DDemetroulis
 * @since version 1.0.0
 */
class Test extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		//if(!$this->input->is_cli_request())
		//{
		//	header('X-Error-Message: Not Found', true, 404);
		//	exit();
		//}
		$this->load->helper('url');
		$this->load->library(array('guzzle', 'unit_test'));
	}

	public function index()
	{
		
	}

	public function get_user()
	{
		$client = new GuzzleHttp\Client(['base_uri' => base_url("test/")]);
		$response = $client->request('GET', 'data');
		print_r(json_decode($response->getBody()->getContents()));
		//$this->unit->run($this->test->get_user(0), 'is_string', "Test get user");
	}
}