<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user');
		$this->form_validation->set_error_delimiters('', '');
	}

	public function index()
	{
		if ( $this->input->post() )
		{
			extract($this->input->post());

			// Uses password_hash($password, PASSWORD_DEFAULT)
			$validation = $this->class_config['validation'];
			if (strpos($username, '@') !== false)
			{
				$this->form_validation->set_rules($validation['login_email']);
				if ($this->form_validation->run() !== FALSE)
				{
					if ($user = $this->validate_user($username, $password))
					{
						$this->session->set_userdata(array(
							'username'	=> $user->username,
							'email'		=> $user->email,
							'loggedIn'	=> TRUE
						));
						redirect('/test');
					}
				}
			}
			else
			{
				$this->form_validation->set_rules($validation['login_username']);
				if ($this->form_validation->run() !== FALSE)
				{
					if ($this->validate_user($username, $password))
					{
						$this->session->set_userdata(array(
								'username'	=> $user->username,
								'email'		=> $user->email,
								'loggedIn'	=> TRUE
						));
						redirect('/test');
					}
				}
			}
		}

		$this->show_view('login');
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
}
