<?php

/**
 * @group patcher
 */
class CIPHPUnitTestPatchPathChecker_test extends PHPUnit_Framework_TestCase
{
	public static function tearDownAfterClass()
	{
		CIPHPUnitTestPatchPathChecker::setIncludePaths(
			[
				APPPATH,
			]
		);
		CIPHPUnitTestPatchPathChecker::setExcludePaths(
			[
				APPPATH . '../vendor/',
				APPPATH . 'tests/',
			]
		);
	}

	public function test_check_true()
	{
		CIPHPUnitTestPatchPathChecker::setIncludePaths(
			[
				APPPATH . 'controllers/',
			]
		);
		$test = CIPHPUnitTestPatchPathChecker::check(APPPATH . 'controllers/abc.php');
		$this->assertTrue($test);
	}

	public function test_check_false()
	{
		CIPHPUnitTestPatchPathChecker::setExcludePaths(
			[
				APPPATH . 'controllers/sub/',
			]
		);
		$test = CIPHPUnitTestPatchPathChecker::check(
			APPPATH . '/controllers/sub/abc.php'
		);
		$this->assertFalse($test);
	}
}
