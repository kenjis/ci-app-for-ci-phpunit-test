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
}
