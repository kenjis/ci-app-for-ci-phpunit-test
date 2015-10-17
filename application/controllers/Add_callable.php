<?php

class Add_callable extends CI_Controller
{
	public function index()
	{
		$this->load->model('greeter');
		$this->load->model('category_model');
		$this->load->library('foo');

		echo $this->greeter->greet()
			. count($this->category_model->get_category_list())
			. $this->foo->doSomething();
	}
}
