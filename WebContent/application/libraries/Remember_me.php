<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Remember_me {
	public function __construct($config = array())
	{
		$this->CI =& get_instance();
		empty($config) OR $this->initialize($config);
		$this->CI->load->helper('cookie');
		$this->CI->load->model('remember');

		log_message('info', 'Remember_me class initialized');
	}

	public function set_cookie($user, $password)
	{
		$code = password_hash($user->id, PASSWORD_DEFAULT);
		$cookie = array(
				'name'   => 'sitehold',
				'value'  => $code,
				'expire' => '7200',
				'domain' => $this->CI->config->item('cookie_domain'),
				'path'   => $this->CI->config->item('cookie_path'),
				'prefix' => $this->CI->config->item('cookie_prefix'),
				'secure' => $this->CI->config->item('cookie_secure')
		);

		set_cookie($cookie);
		$this->CI->remember->add_user_to_remember($user, $password, $code);
	}

	public function get_cookie()
	{
		return get_cookie('sitehold', TRUE);
	}

	public function remove_cookie()
	{
		$code = $this->get_cookie();
		$this->CI->remember->remove_remember_by_remember_id($code);
		delete_cookie('sitehold');
	}

	public function validate_cookie()
	{
		$this->clean_data();
		$code = $this->get_cookie();
		$remember= $this->CI->remember->get_user_by_remember_id($code);
		return (empty($remember)) ? 0 : $remember;
	}
	
	public function clean_data()
	{
		if (rand(1,20) > 15)
		{
			$this->CI->remember->delete_old_records();
		}
	}
}