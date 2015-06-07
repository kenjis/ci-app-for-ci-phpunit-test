<?php

class Redirect_test extends TestCase
{
	public function test_index()
	{
		$this->warningOff();
		$output = $this->request('GET', ['redirect', 'index']);
		$this->warningOn();
		$this->assertNull($output);
	}
}
