<?php

class Method_param_test extends TestCase
{
	public function test_method_param_index()
	{
		$output = $this->request('GET', ['method_param', 'index', 'abc', 'def']);
		$this->assertEquals('param1: abc param2: def', $output);
	}

	public function test_uri_method_param_index()
	{
		$output = $this->request('GET', 'method_param/index/abc/def');
		$this->assertEquals('param1: abc param2: def', $output);
	}
}
