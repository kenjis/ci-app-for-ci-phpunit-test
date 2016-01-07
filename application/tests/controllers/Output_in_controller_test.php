<?php

class Output_in_controller_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'output_in_controller');
		$this->assertEquals('$output is &quot;bra bra bra&quot;', $output);
	}
}
