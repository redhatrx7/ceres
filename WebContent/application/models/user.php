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
}
