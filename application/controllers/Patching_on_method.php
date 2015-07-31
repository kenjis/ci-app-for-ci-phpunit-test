<?php

class Patching_on_method extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model');
	}

	public function index()
	{
		$list = $this->Category_model->get_category_list();
		foreach ($list as $category) {
			echo $category->name . "\n";
		}
	}
}
