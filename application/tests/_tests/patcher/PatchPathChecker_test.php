<?php

namespace Kenjis\MonkeyPatch;

/**
 * @group ci-phpunit-test
 * @group patcher
 */
class PathChecker_test extends \PHPUnit_Framework_TestCase
{
	public static function tearDownAfterClass()
	{
		PathChecker::setIncludePaths(
			[
				APPPATH,
			]
		);
		PathChecker::setExcludePaths(
			[
				APPPATH . 'tests/',
			]
		);
	}

	public function test_check_true()
	{
		PathChecker::setIncludePaths(
			[
				APPPATH . 'controllers/',
			]
		);
		$test = PathChecker::check(APPPATH . 'controllers/abc.php');
		$this->assertTrue($test);
	}

	public function test_check_false()
	{
		PathChecker::setExcludePaths(
			[
				APPPATH . 'controllers/sub/',
			]
		);
		$test = PathChecker::check(
			APPPATH . '/controllers/sub/abc.php'
		);
		$this->assertFalse($test);
	}
}
