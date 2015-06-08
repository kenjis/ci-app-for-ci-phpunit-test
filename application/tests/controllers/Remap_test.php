<?php

class Remap_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', ['remap', '_remap', 'abc']);
		$expected = 'index';
		$this->assertEquals($expected, $output);
	}

	public function test_some_method()
	{
		$output = $this->request('GET', ['remap', '_remap', 'some_method']);
		$expected = 'another';
		$this->assertEquals($expected, $output);
	}
}
