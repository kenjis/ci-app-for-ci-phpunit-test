<?php

class Ci_autoload_library_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'ci_autoload_library/subdir');
		$this->assertEquals('Baz something', $output);
	}
}
