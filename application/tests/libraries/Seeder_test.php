<?php

class Seeder_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->library('Seeder');
		$this->obj = $this->CI->seeder;
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
}
