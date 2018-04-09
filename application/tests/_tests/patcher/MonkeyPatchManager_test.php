<?php

namespace Kenjis\MonkeyPatch;

use TestCase;
use CIPHPUnitTest;
use CIPHPUnitTestReflection;

/**
 * @group ci-phpunit-test
 * @group patcher
 */
class MonkeyPatchManager_test extends TestCase
{
	private static $debug;
	private static $log_file;

	public static function setUpBeforeClass()
	{
		self::$debug = CIPHPUnitTestReflection::getPrivateProperty(MonkeyPatchManager::class, 'debug');
		self::$log_file = CIPHPUnitTestReflection::getPrivateProperty(MonkeyPatchManager::class, 'log_file');

	}

	public static function tearDownAfterClass()
	{
		Cache::clearCache();
		CIPHPUnitTest::setPatcherCacheDir();
		CIPHPUnitTestReflection::setPrivateProperty(MonkeyPatchManager::class, 'debug', self::$debug);
		CIPHPUnitTestReflection::setPrivateProperty(MonkeyPatchManager::class, 'log_file', self::$log_file);
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
