<?php

/**
 * @group ci-phpunit-tests
 * @group patcher
 */
class CIPHPUnitTestPatcher_test extends PHPUnit_Framework_TestCase
{
	public static function tearDownAfterClass()
	{
		self::recursiveUnlink(
			CIPHPUnitTestPatcher::getCacheDir()
		);

		CIPHPUnitTest::setPatcherCacheDir();
	}

	public static function recursiveUnlink($dir)
	{
		if (! is_dir($dir)) {
			return;
		}

		$iterator = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS),
			\RecursiveIteratorIterator::CHILD_FIRST
		);

		foreach ($iterator as $file) {
			if ($file->isDir()) {
				rmdir($file);
			} else {
				unlink($file);
			}
		}

		rmdir($dir);
	}

	public static function getPrivateMethodInvoker($class, $method)
	{
		$ref_method = new ReflectionMethod($class, $method);
		$ref_method->setAccessible(true);
		$obj = (gettype($class) === 'object') ? $class : null;

		return function () use ($class, $ref_method, $obj) {
			$args = func_get_args();
			return $ref_method->invokeArgs($obj, $args);
		};
	}

	public static function setPrivateProperty($class, $property, $value)
	{
		if (is_object($class)) {
			$ref_class = new ReflectionObject($class);
		} else {
			$ref_class = new ReflectionClass($class);
		}
		
		$ref_property = $ref_class->getProperty($property);
		$ref_property->setAccessible(true);
		$ref_property->setValue($value);
	}

	public static function getPrivateProperty($class, $property)
	{
		if (is_object($class)) {
			$ref_class = new ReflectionObject($class);
		} else {
			$ref_class = new ReflectionClass($class);
		}
		
		$ref_property = $ref_class->getProperty($property);
		$ref_property->setAccessible(true);
 
		return $ref_property->getValue();
	}

	/**
	 * @expectedException RuntimeException
	 * @expectedExceptionMessage Failed to create folder:
	 */
	public function test_setCacheDir_error()
	{
		CIPHPUnitTestPatcher::setCacheDir(null);
	}

	/**
	 * @expectedException LogicException
	 * @expectedExceptionMessage You have to set $cache_dir
	 */
	public function test_patch_error()
	{
		CIPHPUnitTestPatcher::patch('dummy');
	}

	public function test_patch_miss_cache()
	{
		$cache_dir = APPPATH . 'tests/_ci_phpunit_test/tmp/cache_test';
		CIPHPUnitTest::setPatcherCacheDir($cache_dir);

		$method = self::getPrivateMethodInvoker('CIPHPUnitTestPatcher', 'getCacheFilePath');
		$cache_file = $method(__FILE__);
		$this->assertFalse(file_exists($cache_file));

		CIPHPUnitTestPatcher::patch(__FILE__);

		$this->assertTrue(file_exists($cache_file));
	}
}
