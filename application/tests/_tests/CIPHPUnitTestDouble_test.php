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

	public function test_getDouble_method_returns_consecutive()
	{
		$returns = ['GET', 'PUT', 'DELETE'];
		$mock = $this->getDouble(
			'CI_Input',
			[
				['method' => $returns],
			]
		);

		$actual = $mock->method();
		$this->assertEquals($returns[0], $actual);

		$actual = $mock->method();
		$this->assertEquals($returns[1], $actual);

		$actual = $mock->method();
		$this->assertEquals($returns[2], $actual);
	}

	public function test_getDouble_returns_consecutive_and_other()
	{
		$returns = ['GET', 'PUT', 'DELETE'];
		$mock = $this->getDouble(
			'CI_Input',
			[
				'get' => [],
				['method' => $returns],
			]
		);

		$actual = $mock->method();
		$this->assertEquals($returns[0], $actual);

		$actual = $mock->method();
		$this->assertEquals($returns[1], $actual);

		$actual = $mock->method();
		$this->assertEquals($returns[2], $actual);

		$actual = $mock->get();
		$this->assertEquals([], $actual);

		$actual = $mock->get();
		$this->assertEquals([], $actual);
	}

	public function test_getDouble_method_returns_execption()
	{
		$this->expectException(Exception::class);
		$this->expectExceptionMessage('I can throw an exception and can use params: abcdef');

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
		$test = $mock->to('test@example.com');

		$this->assertEquals($mock, $test);
	}

	/**
	 * Check if PHPUnit version is equal to or greater
	 *
	 * @param int $major_version
	 *
	 * @return bool
	 */
	private function phpunit_version($major_version) {
		if (class_exists('PHPUnit\Runner\Version')) {
			$phpunit_major_version = (int) PHPUnit\Runner\Version::series();
			if ($phpunit_major_version >= $major_version) {
				return true;
			}
		}

		return false;
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
