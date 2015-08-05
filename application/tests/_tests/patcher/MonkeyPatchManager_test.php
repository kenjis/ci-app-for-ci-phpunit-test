<?php

namespace Kenjis\MonkeyPatch;

use CIPHPUnitTest;

/**
 * @group ci-phpunit-tests
 * @group patcher
 */
class MonkeyPatchManager_test extends \PHPUnit_Framework_TestCase
{
	public static function tearDownAfterClass()
	{
		Cache::clearCache();
		CIPHPUnitTest::setPatcherCacheDir();
	}

	/**
	 * @expectedException RuntimeException
	 * @expectedExceptionMessage Failed to create folder:
	 */
	public function test_setCacheDir_error()
	{
		MonkeyPatchManager::setCacheDir(null);
	}

	/**
	 * @expectedException LogicException
	 * @expectedExceptionMessage Can't read 'dummy'
	 */
	public function test_patch_error_cannot_read_file()
	{
		MonkeyPatchManager::patch('dummy');
	}

	public function test_patch_miss_cache()
	{
		$cache_dir = APPPATH . 'tests/_ci_phpunit_test/tmp/cache_test';
		CIPHPUnitTest::setPatcherCacheDir($cache_dir);

		$cache_file = Cache::getSrcCacheFilePath(__FILE__);
		$this->assertFalse(file_exists($cache_file));

		MonkeyPatchManager::patch(__FILE__);

		$this->assertTrue(file_exists($cache_file));
	}
}
