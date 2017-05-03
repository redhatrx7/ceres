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
		if(!$this->input->is_cli_request())
		{
			header('X-Error-Message: Not Found', true, 404);
			exit();
		}
		print_r('test');
	}
	
	public function index()
	{
		
	}
	
	public function test_get_user()
	{
		print_r($this->get_user(1));
	}
}