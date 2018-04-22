<?php

class Seeder_test extends UnitTestCase
{
	public function setUp()
	{
		$this->obj = $this->newLibrary('Seeder');
	}

	public function test_call_CategorySeeder()
	{
		$expected = [
			1 => 'Book',
			2 => 'CD',
			3 => 'DVD',
		];

		$this->obj->call('CategorySeeder');

		$query = $this->CI->db->query('SELECT id, name FROM category');
		foreach ($query->result() as $row)
		{
			$this->assertEquals($expected[$row->id], $row->name);
		}
	}

	public function test_call_CodeIgniterTestingGuideSeeder()
	{
		$category_expected = [
			1 => 'Book',
			2 => 'CD',
			3 => 'DVD',
		];
		$favorite_expected = [
			1 => 'CodeIgniter Testing Guide',
			2 => 'CodeIgniter tettei nyumon',
		];
		$favorite_detail_expected = [
			1 => 'https://leanpub.com/codeigniter-testing-guide',
			2 => 'https://www.amazon.co.jp/CodeIgniter%E5%BE%B9%E5%BA%95%E5%85%A5%E9%96%80-%E6%B2%B3%E5%90%88-%E5%8B%9D%E5%BD%A6/dp/4798116769',
		];

		$this->obj->setPath(APPPATH.'database/seeds/FavoriteDetail/');
		$this->obj->call('CodeIgniterTestingGuideSeeder');

		$query = $this->CI->db->query('SELECT id, name FROM category');
		foreach ($query->result() as $row)
		{
			$this->assertEquals($category_expected[$row->id], $row->name);
		}

		$query = $this->CI->db->query('SELECT id, category_id, name FROM favorite');
		foreach ($query->result() as $row)
		{
			$this->assertEquals($favorite_expected[$row->id], $row->name);
			$this->assertEquals(1, $row->category_id);
		}

		$query = $this->CI->db->query('SELECT id, retailer_url FROM favorite_detail');
		foreach ($query->result() as $row)
		{
			$this->assertEquals($favorite_detail_expected[$row->id], $row->retailer_url);
		}
	}

}
