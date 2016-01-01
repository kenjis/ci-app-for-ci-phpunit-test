<?php

class Add_callable_pre_constructor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('foo');
	}

	public function index()
	{
		$this->load->model('category_model');
		
		$this->category_model->add_category('Ebook');
		$this->category_model->add_category('Seminar');
		$this->category_model->add_category('Webminar');
		
		$list = $this->category_model->get_category_list();
		foreach ($list as $category) {
			echo $category->name . "\n";
		}
		
		echo $this->foo->doSomething();
	}

	public function list_category()
	{
		$this->load->model('category_model');
		$list = $this->category_model->get_category_list();
		foreach ($list as $category) {
			echo $category->name . "\n";
		}
	}
}
