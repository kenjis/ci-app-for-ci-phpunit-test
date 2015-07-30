<?php

/**
 * @group patcher
 */
class CIPHPUnitTestPatchPathChecker_test extends PHPUnit_Framework_TestCase
{
	public static function tearDownAfterClass()
	{
		CIPHPUnitTestPatchPathChecker::setWhitelistDirs(
			[
				APPPATH,
			]
		);
		CIPHPUnitTestPatchPathChecker::setBlacklistDirs(
			[
				APPPATH . '../vendor/',
				APPPATH . 'tests/',
			]
		);
	}

	public function test_check_true()
	{
		CIPHPUnitTestPatchPathChecker::setWhitelistDirs(
			[
				APPPATH . 'controllers/',
			]
		);
		$test = CIPHPUnitTestPatchPathChecker::check(APPPATH . 'controllers/abc.php');
		$this->assertTrue($test);
	}

	public function test_check_false()
	{
		CIPHPUnitTestPatchPathChecker::setBlacklistDirs(
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
