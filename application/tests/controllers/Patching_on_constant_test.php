<?php

/**
 * @group patcher
 */
class Patching_on_constant_test extends TestCase
{
	public function test_index_development()
	{
		MonkeyPatch::patchConstant('ENVIRONMENT', 'development', 'Patching_on_constant');
		$output = $this->request('GET', 'patching_on_constant');
		$this->assertEquals('development', $output);
	}

	public function test_index_production()
	{
		MonkeyPatch::patchConstant('ENVIRONMENT', 'production', 'Patching_on_constant');
		$output = $this->request('GET', 'patching_on_constant');
		$this->assertEquals('production', $output);
	}
}
