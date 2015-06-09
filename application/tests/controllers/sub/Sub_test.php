<?php

class sub_Sub_test extends TestCase
{
	public function test_uri_sub_sub_index()
	{
		$output = $this->request('GET', 'sub/sub/index');
		$this->assertEquals('index of sub/Sub.php', $output);
	}

	public function test_index()
	{
		$output = $this->request('GET', ['Sub', 'index']);
		$this->assertEquals('index of sub/Sub.php', $output);
	}
}
