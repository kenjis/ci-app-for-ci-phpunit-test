<?php

/**
 * @group patcher
 */
class Patching_on_function_test extends TestCase
{
	public function test_index_patch_on_mt_rand()
	{
		MonkeyPatch::patchFunction('mt_rand', 100);
		$output = $this->request('GET', 'patching_on_function');
		$this->assertContains('100', $output);
	}

	public function test_another_patch_on_mt_rand()
	{
		MonkeyPatch::patchFunction('mt_rand', function($a, $b) {
			return $a . $b;
		});
		$output = $this->request('GET', 'patching_on_function/another');
		$this->assertContains('19', $output);
	}

	/**
	 * This test does not work now
	 */
//	public function test_passing_by_reference_patch_on_preg_replace()
//	{
//		MonkeyPatch::patchFunction(
//			'preg_replace',
//			function($pattern, $replacement, $subject, $limit, &$count) {
//				$count = 999;
//				return 'Patch by Monkey Patching';
//			}
//		);
//		$output = $this->request('GET', 'patching_on_function/passing_by_reference');
//		$this->assertContains('Patch by Monkey Patching', $output);
//		$this->assertContains('999', $output);
//	}
}
