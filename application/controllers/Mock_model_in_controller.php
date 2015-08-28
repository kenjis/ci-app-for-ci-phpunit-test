<?php

class Mock_model_in_controller extends CI_Controller
{
	public function index()
	{
		$this->load->model('Category_model');
		$list = $this->Category_model->get_category_list();
		foreach ($list as $category) {
			echo $category->name . "\n";
		}
	}
}
