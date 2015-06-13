<?php

class Category_model_test extends TestCase
{
	public function setUp()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->library('Seeder');
		$this->CI->seeder->call('CategorySeeder');
		
		$this->CI->load->model('Category_model');
		$this->obj = $this->CI->Category_model;
	}

	public function test_get_category_list()
	{
		$expected = [
			1 => 'Book',
			2 => 'CD',
			3 => 'DVD',
		];
		$list = $this->obj->get_category_list();
		foreach ($list as $category) {
			$this->assertEquals($expected[$category->id], $category->name);
		}
	}
}
