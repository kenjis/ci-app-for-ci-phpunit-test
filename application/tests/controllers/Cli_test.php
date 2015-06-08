<?php

class Cli_test extends TestCase
{
	public function test_index()
	{
		set_is_cli(FALSE);
		$this->warningOff();
		$output = $this->request('GET', ['cli', 'index']);
		$this->warningOn();
		set_is_cli(TRUE);
		$expected = 'Okay';
		$this->assertEquals($expected, $output);
	}
}
