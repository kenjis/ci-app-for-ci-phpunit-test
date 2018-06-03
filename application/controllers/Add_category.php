<?php

/**
 * @property Category_model $Category_model
 */
class Add_category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Category_model');
	}

	public function index()
	{
		$this->Category_model->add_category('a_category_added_by_controller');
	}
}
