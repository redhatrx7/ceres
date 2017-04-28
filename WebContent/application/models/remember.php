<?php

class remember extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	public function get_user_by_remember_id($code)
	{
		$query = $this->db->select('*')->from('ci_remember')->where('DATE_ADD(date, INTERVAL 1 DAY) >= DATE(NOW())')->where(array('code' => $code))->get();
		return $query->row();
	}

	public function add_user_to_remember($user, $password, $code)
	{
		$this->db->insert('ci_remember', array('user_id' => $user->id, 'code' => $code, 'password' => $password));
		return $this->db->affected_rows();
	}
	
	public function delete_old_records()
	{
		$this->db->where('DATE_ADD(date, INTERVAL 1 DAY) < DATE(NOW())');
		$this->db->delete('ci_remember');
		return $this->db->affected_rows();
	}
	
	public function remove_remember_by_remember_id($code)
	{
		$this->db->where(array('code' => $code));
		$this->db->delete('ci_remember');
	}
}
