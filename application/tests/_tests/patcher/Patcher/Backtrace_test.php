<?php

namespace Kenjis\MonkeyPatch\Patcher;

/**
 * @group ci-phpunit-test
 * @group patcher
 */
class Backtrace_test extends \PHPUnit_Framework_TestCase
{
	public function test_getInfo_FunctionPatcher()
	{
		$trace = debug_backtrace();
		$info = Backtrace::getInfo('FunctionPatcher', $trace);

		$this->assertEquals('PHPUnit_Framework_TestCase', $info['class']);
		$this->assertEquals('runBare', $info['method']);
		$this->assertEquals(
			'PHPUnit_Framework_TestCase::runBare', $info['class_method']
		);
		$this->assertNull($info['function']);
	}

	public function test_getInfo_MethodPatcher()
	{
		$trace = debug_backtrace();
		$info = Backtrace::getInfo('MethodPatcher', $trace);

		$this->assertEquals('PHPUnit_Framework_TestCase', $info['class']);
		$this->assertEquals('runTest', $info['method']);
		$this->assertEquals(
			'PHPUnit_Framework_TestCase::runTest', $info['class_method']
		);
		$this->assertNull($info['function']);
	}
}
