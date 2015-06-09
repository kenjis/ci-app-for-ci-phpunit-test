<?php

class Redirect_test extends TestCase
{
	public function test_index()
	{
		$this->warningOff();
		$output = $this->request('GET', ['Redirect', 'index']);
		$this->warningOn();
		$this->assertNull($output);
	}

	public function test_uri_rediret()
	{
		$this->warningOff();
		$output = $this->request('GET', 'redirect');
		$this->warningOn();
		$this->assertNull($output);
	}
}
