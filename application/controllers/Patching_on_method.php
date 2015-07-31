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

	public function auth()
	{
		$this->load->model('Ion_auth_model');
		$id = $this->input->post('id');
		$password = $this->input->post('password');
		$login = $this->Ion_auth_model->login($id, $password);
		
		if (! $login)
		{
			echo 'Error!';
		}
		else
		{
			echo 'Okay!';
		}
	}
}
