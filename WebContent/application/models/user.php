<?php

class user extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	public function get_users()
	{
		$query = $this->db->get('user', 1);
		return $query->result();
	}

	public function get_user_by_username_email($username)
	{
		$query = $this->db->select('*')->from('user')->where(array('username' => $username))->or_where(array('email' => $username))->get();
		return $query->row();
	}
	
	public function get_user_by_id($id)
	{
		$query = $this->db->select('*')->from('user')->where(array('id' => $id))->get();
		return $query->row();
	}
}
