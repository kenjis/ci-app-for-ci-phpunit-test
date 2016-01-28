<?php

class Output_in_controller_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'output_in_controller');
		$this->assertEquals('$output is &quot;bra bra bra&quot;', $output);
	}

	public function test_index_directly()
	{
		$output = $this->request('GET', ['Output_in_controller', 'index']);
		$this->assertEquals('bra bra bra', $output);
	}

	public function test_output()
	{
		$output = $this->request('GET', ['Output_in_controller', '_output', 'abc']);
		$this->assertEquals('$output is &quot;abc&quot;', $output);
	}
}
