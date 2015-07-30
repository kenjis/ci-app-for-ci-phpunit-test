<?php

/**
 * @group patcher
 */
class Patching_on_function_test extends TestCase
{
	public function tearDown()
	{
		parent::tearDown();
		$this->resetFunctionPatches();
	}

	public function test_index_patch_on_mt_rand()
	{
		$this->patchFunction('mt_rand', 100);
		$output = $this->request('GET', 'patching_on_function');
		$this->assertContains('100', $output);
	}

	public function test_another_patch_on_mt_rand()
	{
		$this->patchFunction('mt_rand', function($a, $b) {
			return $a . $b;
		});
		$output = $this->request('GET', 'patching_on_function/another');
		$this->assertContains('19', $output);
	}
}
