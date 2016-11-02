<?php

/**
 * @group ci-phpunit-test
 */
class CIPHPUnitTestDouble_test extends TestCase
{
	public function test_getDouble_method_named_method()
	{
		$expected = 'DELETE';
		$mock = $this->getDouble('CI_Input', ['method' => $expected]);
		$actual = $mock->method();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage I can thrnow an error and can use params: abcdef
	 */
	public function test_getDouble_method_returns_execption()
	{
		$expected = function ($param1, $param2) {
			throw new Exception('I can thrnow an error and can use params: '.$param1.$param2);
		};
		$mock = $this->getDouble('CI_Input', ['method' => $expected]);
		$mock->method('abc', 'def');
	}
}
