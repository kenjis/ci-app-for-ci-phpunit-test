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

	public function provide_PHP5_trace()
	{
		return array (
			0 => 
			array (
				'file' => '/vagrant/debug_backtrace/Proxy.php',
				'line' => 7,
				'function' => 'checkCalledMethod',
				'class' => 'Proxy',
				'type' => '::',
				'args' => 
				array (
					0 => 'bar',
				),
			),
			1 => 
			array (
				'file' => '/vagrant/debug_backtrace/Test.php',
				'line' => 7,
				'function' => '__callStatic',
				'class' => 'Proxy',
				'type' => '::',
				'args' => 
				array (
					0 => 'bar',
					1 => 
					array (
					),
				),
			),
			2 => 
			array (
				'file' => '/vagrant/debug_backtrace/Test.php',
				'line' => 7,
				'function' => 'bar',
				'class' => 'Proxy',
				'type' => '::',
				'args' => 
				array (
				),
			),
			3 => 
			array (
				'file' => '/vagrant/debug_backtrace/app.php',
				'line' => 7,
				'function' => 'run',
				'class' => 'Test',
				'object' => 
					new \stdClass,	// dummy
				'type' => '->',
				'args' => 
				array (
				),
			),
		);
	}

	public function provide_PHP7_trace()
	{
		return array (
			0 => 
			array (
				'file' => '/vagrant/debug_backtrace/Proxy.php',
				'line' => 7,
				'function' => 'checkCalledMethod',
				'class' => 'Proxy',
				'type' => '::',
				'args' => 
				array (
					0 => 'bar',
				),
			),
			1 => 
			array (
				'file' => '/vagrant/debug_backtrace/Test.php',
				'line' => 7,
				'function' => '__callStatic',
				'class' => 'Proxy',
				'type' => '::',
				'args' => 
				array (
					0 => 'bar',
					1 => 
					array (
					),
				),
			),
			2 => 
			array (
				'file' => '/vagrant/debug_backtrace/app.php',
				'line' => 7,
				'function' => 'run',
				'class' => 'Test',
				'object' => 
					new \stdClass,	// dummy
				'type' => '->',
				'args' => 
				array (
				),
			),
		);
	}

	public function test_getInfo_FunctionPatcher_callStatic()
	{
		if (version_compare(PHP_VERSION, '6.0.0', '>='))
		{
			$trace = $this->provide_PHP7_trace();
		}
		else
		{
			$trace = $this->provide_PHP5_trace();
		}

		$info = Backtrace::getInfo('FunctionPatcher', $trace);

		$this->assertEquals('Test', $info['class']);
		$this->assertEquals('run', $info['method']);
		$this->assertEquals(
			'Test::run', $info['class_method']
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
