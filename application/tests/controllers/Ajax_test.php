<?php

class Ajax_test extends TestCase
{
	public function test_index_non_ajax_call()
	{
		$output = $this->request('GET', 'ajax/index');
		$expected = 'Not Ajax request';
		$this->assertEquals($expected, $output);
	}

	public function test_index_ajax_call()
	{
		$output = $this->ajaxRequest('GET', 'ajax/index');
		$expected = 'Ajax request';
		$this->assertEquals($expected, $output);
	}

	public function test_index_non_ajax_call_again()
	{
		$output = $this->request('GET', 'ajax/index');
		$expected = 'Not Ajax request';
		$this->assertEquals($expected, $output);
	}
}
