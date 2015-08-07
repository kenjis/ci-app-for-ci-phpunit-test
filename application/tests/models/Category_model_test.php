<?php

class Category_model_test extends TestCase
{
	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();
		
		$CI =& get_instance();
		$CI->load->library('Seeder');
		$CI->seeder->call('CategorySeeder');
	}

	public function setUp()
	{
		$this->resetInstance();
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
