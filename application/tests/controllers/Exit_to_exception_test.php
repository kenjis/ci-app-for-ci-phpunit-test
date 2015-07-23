<?php

class Exit_to_exception_test extends TestCase
{

	public function test_index()
	{
		try {
			$output = $this->request('GET', 'exit_to_exception');
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
			$this->assertEquals('Exit_to_exception', $e->class);
			$this->assertEquals('index', $e->method);
			$this->assertNull($e->exit_status);
		}
		$this->assertContains('{"foo":"bar"}', $output);
	}
}
