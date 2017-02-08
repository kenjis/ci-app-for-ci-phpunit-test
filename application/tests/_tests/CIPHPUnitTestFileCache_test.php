<?php

/**
 * @group ci-phpunit-test
 */
class CIPHPUnitTestFileCache_test extends TestCase
{
	public static function setUpBeforeClass()
	{
		$cache_file = __DIR__.'/tmp/cache.php';
		@unlink($cache_file);
	}

	public static function tearDownAfterClass()
	{
		$cache_file = __DIR__.'/tmp/cache.php';
		unlink($cache_file);
		rmdir(__DIR__.'/tmp');
	}

	public function setUp()
	{
		$this->cache_file = __DIR__.'/tmp/cache.php';
		$this->obj = new CIPHPUnitTestFileCache($this->cache_file);
	}

	public function tearDown()
	{
		chmod(__DIR__.'/tmp', 0777);
		unset($this->obj);
	}

	public function test_construct_new_cache_file_create()
	{
		$this->assertTrue(file_exists($this->cache_file));
	}

	/**
	 * @expectedException        RuntimeException
	 * @expectedExceptionMessage Failed to write to cache file:
	 */
	public function test_construct_fail_to_create_cache_file()
	{
		chmod(__DIR__.'/tmp', 0);
		$cache_file = __DIR__.'/tmp/cache_fail.php';
		if (file_put_contents($cache_file, '') !== false)
		{
			unlink($cache_file);
			$this->markTestSkipped('Ignored for root user');
		}
		@new CIPHPUnitTestFileCache($cache_file);
	}

	/**
	 * @expectedException        RuntimeException
	 * @expectedExceptionMessage Failed to create folder:
	 */
	public function test_construct_fail_to_create_dir()
	{
		chmod(__DIR__.'/tmp', 0);
		$cache_file = __DIR__.'/tmp/sub/cache_fail.php';
		$dir = dirname($cache_file);
		if (@mkdir($dir, 0777, true) !== false)
		{
			rmdir($dir);
			$this->markTestSkipped('Ignored for root user');
		}
		@new CIPHPUnitTestFileCache($cache_file);
	}

	public function test_set()
	{
		$this->obj['key_abc'] = 'val_abc';
		$this->obj['key_xyz'] = 'val_xyz';
		$this->assertEquals('val_abc', $this->obj['key_abc']);
		$this->assertEquals('val_xyz', $this->obj['key_xyz']);
	}

	public function test_get_key_not_exist()
	{
		$this->assertNull($this->obj['not_exist']);
	}

	public function test_unset()
	{
		$this->assertEquals('val_xyz', $this->obj['key_xyz']);
		unset($this->obj['key_xyz']);
		$this->assertNull($this->obj['key_xyz']);
	}

	public function test_destruct()
	{
		unset($this->obj['key_abc']);
		unset($this->obj['key_xyz']);
		unset($this->obj);
		$this->assertEquals('a:0:{}', file_get_contents($this->cache_file));
	}
}
