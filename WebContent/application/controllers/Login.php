<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'language'));
		$this->load->library('form_validation');
		$this->load->model('user');
		$this->load->library('remember_me');
		$this->form_validation->set_error_delimiters('', '');
		$this->lang->load(array('general', 'login'), $this->language);
	}

	public function index($language=NULL)
	{
		$data = array('username' => '', 'password' => '', 'show_password' => FALSE);
		$session = $this->session->userdata();

		if ( $this->input->post() )
		{
			extract($this->input->post());

			// Uses password_hash($password, PASSWORD_DEFAULT)
			$validation = $this->class_config['validation'];

			$this->form_validation->set_rules((strpos($username, '@')) ?
					$validation['login_email'] : $validation['login_username']);

			if ($this->form_validation->run() === TRUE)
			{
				if ($user = $this->validate_user($username, $password))
				{
					$old_remember = $this->remember_me->validate_cookie();

					if ($old_remember)
					{
						$this->remember_me->remove_cookie();
					}

					if (isset($remember))
					{
						$this->remember_me->set_cookie($user, $password);
					}

					$this->session->set_userdata(array(
						'user' => array(
							'username'	=> $user->username,
							'email'		=> $user->email,
							'loggedIn'	=> TRUE
						)
					));

					redirect('/welcome');
				}
				else {
					$this->form_validation->set_post_validation_error('password', 'no_user');
				}
			}
		}
		elseif( ! isset($session['user']))
		{
			$remember = $this->remember_me->validate_cookie();

			if ($remember)
			{
				$user = $this->user->get_user_by_id($remember->user_id);
				$data['username'] = $user->username;
				$data['password'] = $remember->password;
				$data['show_password'] = TRUE;
				if ( ! empty($user))
				{
					$this->show_view('login', array('data' => $data));
				}
			}
		}

		// sort language list and put current language to the top
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

	public function get_signout()
	{
		$this->session->sess_destroy();
		$this->remember_me->remove_cookie();

		$this->load->view('json', array('response' => array('passed' => TRUE)));
	}

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
