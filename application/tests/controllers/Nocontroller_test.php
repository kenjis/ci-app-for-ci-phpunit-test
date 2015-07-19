<?php

class Nocontroller_test extends TestCase
{
	public function test_method_404()
	{
		$output = $this->request('GET', ['nocontroller', 'nomethod']);
		$this->assertResponseCode(404);
	}

	public function test_uri_404()
	{
		$output = $this->request('GET', 'nocontroller/nomethod');
		$this->assertResponseCode(404);
	}
}
