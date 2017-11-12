<?php

class Interface_test extends TestCase
{
	public function test_test()
	{
		$output = $this->request('GET', 'interface_test/test');
		$expected = 'Okay';
		$this->assertEquals($expected, $output);
	}
}
