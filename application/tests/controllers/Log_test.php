<?php

class Log_test extends TestCase
{
	public function test_index()
	{
		$this->request('GET', 'log');

		$this->assertLogged('error', 'This is an error.');
	}
}
