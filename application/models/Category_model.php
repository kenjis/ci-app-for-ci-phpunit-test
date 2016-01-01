<?php

class Category_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_category_list()
	{
		$this->db->order_by('id');
		$query = $this->db->get('category');
		return $query->result();
	}

	public function add_category($name)
	{
		$data = [
			'name' => $name,
		];
		$this->db->insert('category', $data);
	}
}
