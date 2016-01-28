<?php

class Remap_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'remap/abc');
		$expected = 'index';
		$this->assertEquals($expected, $output);
	}

	public function test_another()
	{
		$output = $this->request('GET', 'remap/some_method');
		$expected = 'another';
		$this->assertEquals($expected, $output);
	}

	public function test_remap_abc()
	{
		$output = $this->request('GET', ['Remap', '_remap', 'abc']);
		$expected = 'index';
		$this->assertEquals($expected, $output);
	}

	public function test_remap_some_method()
	{
		$output = $this->request('GET', ['Remap', '_remap', 'some_method']);
		$expected = 'another';
		$this->assertEquals($expected, $output);
	}
}
