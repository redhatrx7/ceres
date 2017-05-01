<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class handles the login page.
 * 
 * Login, logout, and get currently user chosen language.
 *
 * @package ceres
 * @author DDemetroulis
 * @since version 1.0.0
 * @see MY_Controller
 */
class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper(array('form', 'language'));

		// Libraries
		$this->load->library('form_validation');
		$this->load->library('remember_me');

		// Models
		$this->load->model('user');

		$this->lang->load(array('general', 'login'), $this->language);
		$this->form_validation->set_error_delimiters('', '');
	}

	/**
	 * Loads Initial login page view
	 *
	 * @param string $language
	 * @return login (View)
	 */
	public function index($language=NULL)
	{
		$session = $this->session->userdata();

		// Basic array to fill in form data for login (current username, password, and whether to fill in the password)
		$data = array('username' => '', 'password' => '', 'show_password' => FALSE);
		

		// If the login button has been pressed
		if ($this->input->post())
		{
			//$password, $username, $remember to current symbol table
			extract($this->input->post());

			// Uses password_hash($password, PASSWORD_DEFAULT)
			$validation = $this->class_config['validation'];

			// Use either the username or email validation
			$this->form_validation->set_rules((strpos($username, '@')) ?
					$validation['login_email'] : $validation['login_username']);

			// Is form data validated
			if ($this->form_validation->run() === TRUE)
			{
				// Is user validated with DB
				if ($user = $this->validate_user($username, $password))
				{
					// Get current remember me cookie and remove it
					$old_remember = $this->remember_me->validate_cookie();
					if ($old_remember)
					{
						$this->remember_me->remove_cookie();
					}

					// If remember me was checked add a remember me cookie
					if (isset($remember))
					{
						$this->remember_me->set_cookie($user, $password);
					}

					// Set the current user session
					$this->session->set_userdata(array(
						'user' => array(
							'username'	=> $user->username,
							'email'		=> $user->email,
							'loggedIn'	=> TRUE
						)
					));

					// Direct user to welcome page if successful login
					redirect('/welcome');
				}
				else
				{
					$this->form_validation->set_post_validation_error('password', 'no_user');
				}
			}
		}
		elseif( ! isset($session['user']))
		{
			// If the session is not set and there is a remember me cookie set, fill in form data with username/password
			$remember = $this->remember_me->validate_cookie();
			if ($remember)
			{
				$user = $this->user->get_user_by_id($remember->user_id);
				$data['username'] = $user->username;
				$data['password'] = $remember->password;
				$data['show_password'] = TRUE;
			}
		}

		// sort the list of supported languages and put current language to the top
		$languages = $this->config->item('languages');
		asort($languages);
		$key = array_search($this->language, $languages);
		unset($languages[$key]);
		array_unshift($languages, $this->language);

		$this->show_view('login', array(
				'data' => $data,
				'language' => $this->language,
				'languages' => $languages
			)
		);
	}

	/**
	 * Validate a user by email or username and return the user if exists
	 * 
	 * @param string $username
	 * @param string $password
	 * @return array|boolean
	 */
	private function validate_user( $username, $password )
	{
		if ( $username )
		{
			$user = $this->user->get_user_by_username_email($username);
			if ( ! empty($user))
			{
				if (password_verify($password,$user->password))
				{
					return $user;
				}
			}
		}

		return FALSE;
	}

	/**
	 * Sign Out a user
	 * 
	 * Destroy the session and remember me cookie
	 */
	public function get_signout()
	{
		$this->session->sess_destroy();
		$this->remember_me->remove_cookie();

		$this->load->view('json', array('response' => array('passed' => TRUE)));
	}

	/**
	 * Change the current language to user selected value if language is supported
	 * @param string $language
	 */
	public function get_language($language)
	{
		$languages = $this->config->item('languages');

		if ( in_array($language, $languages) )
		{
			$this->session->set_userdata('language', $language);
			$this->load->view('json', array('response' => array('language' => $language)));
		}
		else
		{
			header('X-Error-Message: Invalid Request', true, 400);
			die();
		}
	}
}
