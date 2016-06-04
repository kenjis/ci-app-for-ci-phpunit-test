<?php

class Sessions_test extends TestCase
{
	public function test_super_global()
	{
		$output = $this->request('GET', 'sessions/super_global');
		$expected = 'super_global';
		$this->assertEquals($expected, $output);
	}

	public function test_property()
	{
		$output = $this->ajaxRequest('GET', 'sessions/property');
		$expected = 'property';
		$this->assertEquals($expected, $output);
	}

	public function test_set_userdata()
	{
		$output = $this->request('GET', 'sessions/set_userdata');
		$expected = 'set_userdata';
		$this->assertEquals($expected, $output);
	}

	public function test_logged_in()
	{
		$this->request->setCallable(
			function ($CI) {
				$CI->session->logged_in = 'true';
			}
		);
		$output = $this->request('GET', 'sessions/logged_in');
		$expected = 'true';
		$this->assertEquals($expected, $output);
	}
}
