<?php

class Show404_test extends TestCase
{
	public function test_index()
	{
		$this->request('GET', 'show404');
		$this->assertResponseCode(404);
	}
}
