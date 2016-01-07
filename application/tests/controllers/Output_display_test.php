<?php

class Output_display_test extends TestCase
{
	public function test_index()
	{
		try {
			$output = $this->request('GET', 'output_display');
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}

		$expected = <<<'EOL'
{
    "status": "OK"
}
EOL;
		$this->assertContains($expected, $output);
	}
}
