<?php

class sub_Sub_method_param_test extends TestCase
{
	public function test_uri_sub_sub_method_param_index()
	{
		$output = $this->request('GET', 'sub/sub_method_param/index/abc/def');
		$this->assertEquals('param1: abc param2: def', $output);
	}
}
