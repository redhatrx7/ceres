<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Handles remember cookies
 * 
 * @package ceres
 * @author DDemetroulis
 * @since version 1.0.0
 */
class Remember_me
{
	public function __construct($config = array())
	{
		$this->CI =& get_instance();
		empty($config) OR $this->initialize($config);

		$this->CI->load->helper('cookie');
		$this->CI->load->model('remember');

		log_message('info', 'Remember_me class initialized');
	}

	/**
	 * Sets a remember me cookie
	 * 
	 * Hashes a speical key that is the key to the cookie as well as tracked in the DB
	 * 
	 * @param array $user
	 * @param string $password
	 */
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

	/**
	 * Gets the current remember me cookie
	 */
	public function get_cookie()
	{
		return get_cookie('sitehold', TRUE);
	}

	/**
	 * Removes the current remember me cookie and removes it form the DB
	 */
	public function remove_cookie()
	{
		$code = $this->get_cookie();

		$this->CI->remember->remove_remember_by_remember_id($code);
		delete_cookie('sitehold');
	}

	/**
	 * Returns the users id given a remember me cookie
	 *
	 * @return number
	 */
	public function validate_cookie()
	{
		$this->clean_data();

		$code = $this->get_cookie();
		$remember= $this->CI->remember->get_user_by_remember_id($code);

		return (empty($remember)) ? 0 : $remember;
	}

	/**
	 * Removes old cookies older than a day from the DB
	 */
	private function clean_data()
	{
		if (rand(1,20) > 15)
		{
			$this->CI->remember->delete_old_records();
		}
	}
}