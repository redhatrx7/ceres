<?php

/**
 * User model for user operations
 * 
 * @package ceres
 * @author DDemetroulis
 * @since version 1.0.0
 * @see CI_Model
 */
class user extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * Get first user from DB
	 * @return array
	 */
	public function get_users()
	{
		$query = $this->db->get('user', 1);
		return $query->result();
	}

	/**
	 * Get a user by username or email
	 * @param string $username
	 * @return array
	 */
	public function get_user_by_username_email($username)
	{
		$query = $this->db->select('*')->from('user')->where(array('username' => $username))->or_where(array('email' => $username))->get();
		return $query->row();
	}

	/**
	 * Get a user by the user id
	 * 
	 * @param int $id
	 * @return array
	 */
	public function get_user_by_id($id)
	{
		$query = $this->db->select('*')->from('user')->where(array('id' => $id))->get();
		return $query->row();
	}

	/**
	 * Create a new user
	 *
	 * @param array $user
	 * @return number
	 */
	public function create_user($user)
	{
		$this->db->insert('user', array(
				'firstname' => $user['firstname'],
				'lastname' 	=> $user['lastname'],
				'username' 	=> $user['username'],
				'email'		=> $user['email'],
				'password'	=> $user['password'],
				'birthdate' => $user['birthdate']
			)
		);
		return $this->db->affected_rows();
	}
}
