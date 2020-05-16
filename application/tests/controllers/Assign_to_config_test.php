<?php

class Assign_to_config_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'assign_to_config');
		$expected = 'value of config item';
		$this->assertEquals($expected, $output);
	}

	public function test_index_again()
	{
		$output = $this->request('GET', 'assign_to_config');
		$expected = 'value of config item';
		$this->assertEquals($expected, $output);
	}
}
