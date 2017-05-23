<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class handles the login page.
 * 
 * Signup page, create an account
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

		$this->lang->load(array('general', 'login', 'signup'), $this->language);
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
		$today = new DateTime('now');
		$ago = $today;
		$error = FALSE;

		// Basic array to fill in form data for signup
		$data = array('username' => '', 'password' => '', 'email' => '', 'first_name' => '', 'last_name' => '', 'birthdate' => '');

		$ago->modify('-150 year');
		$data['min_date'] = $ago->format('Y-m-d');

		// If the Create Account button has been pressed
		if ($this->input->post())
		{
			// $first_name, $last_name, $password, $username, $email, $email_confirm, $birthdate to current symbol table
			extract($this->input->post());

			// Validation on all form fields
			$validation = $this->class_config['validation'];
			$this->form_validation->set_rules($validation);

			// Is form data validated
			if ($this->form_validation->run() === TRUE)
			{
				if ( $birthdate > $ago AND $birthdate < $today )
				{
					//SUCCESS
				}
				else
				{
					$error = TRUE;
					$this->form_validation->set_post_validation_error('birthdate', 'invalid_date');
				}
			}
			else
			{
				$error = TRUE;
			}

			if ($error)
			{
				// If validation fails set field data
				$data['username'] 	= $username;
				$data['email'] 		= $email;
				$data['first_name'] = $first_name;
				$data['last_name'] 	= $last_name;
				$data['birthdate'] 	= $birthdate;
				$data['password'] 	= $password;
			}
		}

		$this->show_view('signup', array(
				'data' => $data,
				'language' => $this->language
			)
		);
	}
}
