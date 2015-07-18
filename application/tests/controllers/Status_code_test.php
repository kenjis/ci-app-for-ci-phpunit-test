<?php

class Status_code_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'status_code');
		$this->assertEquals('', $output);
		$this->assertResponseCode(400);
	}
}
