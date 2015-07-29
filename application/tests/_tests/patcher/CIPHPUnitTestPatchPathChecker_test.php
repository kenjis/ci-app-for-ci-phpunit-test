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
				realpath(APPPATH . '../vendor/'),
				APPPATH . 'tests/',
			]
		);
	}

	public function test_check_true()
	{
		CIPHPUnitTestPatchPathChecker::setWhitelistDirs(
			[
				'/abc/def',
			]
		);
		$test = CIPHPUnitTestPatchPathChecker::check('/abc/def/xyz');
		$this->assertTrue($test);
	}

	public function test_check_false()
	{
		CIPHPUnitTestPatchPathChecker::setBlacklistDirs(
			[
				'/abc/def/xyz',
			]
		);
		$test = CIPHPUnitTestPatchPathChecker::check('/abc/def/xyz/123');
		$this->assertFalse($test);
	}
}
