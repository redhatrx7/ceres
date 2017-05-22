<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class handles the login page.
 * 
 * Signup page
 *
 * @package ceres
 * @author DDemetroulis
 * @since version 1.0.0
 * @see MY_Controller
 */
class Signup extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper(array('form', 'language'));

		// Libraries
		$this->load->library('form_validation');

		// Models
		$this->load->model('user');

		$this->lang->load(array('general', 'login'), $this->language);
		$this->form_validation->set_error_delimiters('', '');
	}

	/**
	 * Loads Initial signup page view
	 *
	 * @return signup (View)
	 */
	public function index()
	{
		$data = array();
		$this->show_view('signup', array(
				'data' => $data,
				'language' => $this->language
			)
		);
	}
}
