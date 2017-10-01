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
	 * @expectedExceptionMessage I can throw an exception and can use params: abcdef
	 */
	public function test_getDouble_method_returns_execption()
	{
		$ret = function ($param1, $param2) {
			throw new Exception('I can throw an exception and can use params: '.$param1.$param2);
		};
		$mock = $this->getDouble('CI_Input', ['method' => $ret]);
		$mock->method('abc', 'def');
	}

	public function test_getDouble_constructor_param()
	{
		$mock = $this->getDouble(
			'SplFileObject',
			[
				'current' => ['foo', 'bar'],
				'next'    => NULL
			],
			['php://memory']
		);
		$this->assertEquals(NULL, $mock->next());
	}

	public function test_getDobule_method_returns_phpunit_stub()
	{
		$mock = $this->getDouble('CI_Email', ['to' => $this->returnSelf()]);
		$expected = $mock->to('test@example.com');
		$this->assertEquals($expected, $mock);
	}

	public function test_verifyInvokedOnce_with_params()
	{
		$expected = 'DELETE';
		$mock = $this->getDouble('CI_Input', ['method' => $expected]);
		$this->verifyInvokedOnce($mock, 'method', [true]);
		$mock->method(true);
	}

	public function test_verifyInvokedOnce_without_params()
	{
		$expected = 'DELETE';
		$mock = $this->getDouble('CI_Input', ['method' => $expected]);
		$this->verifyInvokedOnce($mock, 'method');
		$mock->method();
	}
}
