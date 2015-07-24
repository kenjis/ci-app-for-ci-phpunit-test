<?php

class Show_error_test extends TestCase
{
	public function test_index()
	{
		$this->request('GET', 'show_error');
		$this->assertResponseCode(500);
	}
}
