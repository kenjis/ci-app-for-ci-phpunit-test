<?php

class Ajax_test extends TestCase
{
	public function test_index_non_ajax_call()
	{
		$output = $this->request('GET', ['Ajax', 'index']);
		$expected = 'Not Ajax request';
		$this->assertEquals($expected, $output);
	}

	public function test_index_ajax_call()
	{
		$output = $this->ajaxRequest('GET', ['Ajax', 'index']);
		$expected = 'Ajax request';
		$this->assertEquals($expected, $output);
	}

	public function test_index_non_ajax_call_again()
	{
		$output = $this->request('GET', ['Ajax', 'index']);
		$expected = 'Not Ajax request';
		$this->assertEquals($expected, $output);
	}
}
