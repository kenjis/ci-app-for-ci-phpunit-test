<?php

class sub_bar_Sub_bar_test extends TestCase
{
	public function test_index_classmethod()
	{
		$output = $this->request('GET', ['Sub_bar', 'index']);
		$this->assertEquals('index of sub/bar/Sub_bar.php', $output);
	}

	public function test_index_uri()
	{
		$output = $this->request('GET', 'sub/bar/sub_bar/index');
		$this->assertEquals('index of sub/bar/Sub_bar.php', $output);
	}
}
