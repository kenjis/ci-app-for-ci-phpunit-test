<?php

namespace Kenjis\MonkeyPatch;

use CIPHPUnitTest;
use CIPHPUnitTestReflection;

/**
 * @group ci-phpunit-tests
 */
class Cache_test extends \PHPUnit_Framework_TestCase
{
	public static function tearDownAfterClass()
	{
		Cache::clearCache();
		CIPHPUnitTest::setPatcherCacheDir();
	}

	public function test_setCacheDir()
	{
		$cache_dir = APPPATH . 'tests/_ci_phpunit_test/tmp/cache_test';
		Cache::setCacheDir($cache_dir);
		$this->assertEquals(realpath($cache_dir), Cache::getCacheDir());
	}

	public function test_writeTmpFunctionWhitelist()
	{
		Cache::createTmpListDir();
		$list = [
			'file_exists',
			'file_get_contents',
			'file_put_contents',
		];
		Cache::writeTmpFunctionWhitelist($list);
		
		$actual = Cache::getTmpFunctionWhitelist();
		$this->assertEquals($list, $actual);
	}

	public function test_writeTmpPatcherList()
	{
		$list = [
			'ExitPatcher',
			'FunctionPatcher',
			'MethodPatcher',
		];
		Cache::writeTmpPatcherList($list);
		
		$actual = Cache::getTmpPatcherList();
		$this->assertEquals($list, $actual);
	}

	public function test_writeTmpIncludePaths()
	{
		$list = [
			APPPATH,
			BASEPATH,
		];
		Cache::writeTmpIncludePaths($list);
		
		$actual = Cache::getTmpIncludePaths();
		$this->assertEquals($list, $actual);
	}

	public function test_writeTmpExcludePaths()
	{
		$list = [
			APPPATH.'test',
		];
		Cache::writeTmpExcludePaths($list);
		
		$actual = Cache::getTmpExcludePaths();
		$this->assertEquals($list, $actual);
	}

	public function test_clearSrcCache()
	{
		Cache::clearSrcCache();
		$this->assertFalse(file_exists(
			CIPHPUnitTestReflection::getPrivateProperty(
				__NAMESPACE__.'\Cache', 'src_cache_dir'
			)
		));
	}

	public function test_clearCache()
	{
		Cache::clearCache();
		$this->assertFalse(file_exists(
			CIPHPUnitTestReflection::getPrivateProperty(
				__NAMESPACE__.'\Cache', 'cache_dir'
			)
		));
	}
}
