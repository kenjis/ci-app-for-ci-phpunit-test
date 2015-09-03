<?php

/**
 * @group ci-phpunit-test
 */
class CIPHPUnitTestReflection_test extends TestCase
{
	public function test_getPrivateProperty_object()
	{
		$obj = new __TestForCIPHPUnitTestReflection();
		$actual = $this->reflection->getPrivateProperty($obj, 'private');
		$this->assertEquals('secret', $actual);
	}

	public function test_getPrivateProperty_static()
	{
		$actual = $this->reflection->getPrivateProperty(
			'__TestForCIPHPUnitTestReflection', 'static_private'
		);
		$this->assertEquals('xyz', $actual);
	}

	public function test_setPrivateProperty_object()
	{
		$obj = new __TestForCIPHPUnitTestReflection();
		$this->reflection->setPrivateProperty(
			$obj, 'private', 'open'
		);
		$this->assertEquals('open', $obj->getPrivate());
	}

	public function test_setPrivateProperty_static()
	{
		$this->reflection->setPrivateProperty(
			'__TestForCIPHPUnitTestReflection', 'static_private', 'abc'
		);
		$this->assertEquals(
			'abc', __TestForCIPHPUnitTestReflection::getStaticPrivate()
		);
	}

	public function test_getPrivateMethodInvoker_object()
	{
		$obj = new __TestForCIPHPUnitTestReflection();
		$method = $this->reflection->getPrivateMethodInvoker(
			$obj, 'privateMethod'
		);
		$this->assertEquals(
			'private param1param2', $method('param1', 'param2')
		);
	}

	public function test_getPrivateMethodInvoker_static()
	{
		$method = $this->reflection->getPrivateMethodInvoker(
			'__TestForCIPHPUnitTestReflection', 'privateStaticMethod'
		);
		$this->assertEquals(
			'private_static param1param2', $method('param1', 'param2')
		);
	}
}

class __TestForCIPHPUnitTestReflection
{
	private $private = 'secret';
	private static $static_private = 'xyz';

	public function getPrivate()
	{
		return $this->private;
	}

	public static function getStaticPrivate()
	{
		return self::$static_private;
	}

	private function privateMethod($param1, $param2)
	{
		return 'private ' . $param1 . $param2;
	}

	private static function privateStaticMethod($param1, $param2)
	{
		return 'private_static ' . $param1 . $param2;
	}
}
