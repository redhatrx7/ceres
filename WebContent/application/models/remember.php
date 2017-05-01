<?php
/**
 * Model for remember me cookie tracking in the DB
 * 
 * @package ceres
 * @author DDemetroulis
 * @since version 1.0.0
 * @see CI_Model
 */
class remember extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * Get user by the remember me code saved in the cookie
	 * 
	 * @param string $code
	 * @return array
	 */
	public function get_user_by_remember_id($code)
	{
		$query = $this->db->select('*')->from('ci_remember')->where('DATE_ADD(date, INTERVAL 1 DAY) >= DATE(NOW())')->where(array('code' => $code))->get();
		return $query->row();
	}

	/**
	 * Add a user entry for a remember me cookie
	 * 
	 * @param array $user
	 * @param string $password
	 * @param string $code
	 * @return number
	 */
	public function add_user_to_remember($user, $password, $code)
	{
		$this->db->insert('ci_remember', array('user_id' => $user->id, 'code' => $code, 'password' => $password));
		return $this->db->affected_rows();
	}

	/**
	 * Delete old records older than a day from its creation date
	 *
	 * @return number
	 */
	public function delete_old_records()
	{
		$this->db->where('DATE_ADD(date, INTERVAL 1 DAY) < DATE(NOW())');
		$this->db->delete('ci_remember');

		return $this->db->affected_rows();
	}

	/**
	 * remove a users remember me cookie in the DB by its special code
	 *
	 * @param string $code
	 * @return number
	 */
	public function remove_remember_by_remember_id($code)
	{
		$this->db->where(array('code' => $code));
		$this->db->delete('ci_remember');

		return $this->db->affected_rows();
	}
}
