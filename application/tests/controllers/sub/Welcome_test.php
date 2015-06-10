<?php

class sub_Welcome_test extends TestCase
{
	/**
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function test_uri_sub_welcome_index()
	{
		$output = $this->request('GET', 'sub/welcome/index');
		$this->assertEquals('sub/Welcome.php', $output);
	}
}
