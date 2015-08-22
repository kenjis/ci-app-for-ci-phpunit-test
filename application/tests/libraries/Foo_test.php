<?php

/**
 * This test case is to test autoloading of library
 */
class Foo_test extends TestCase
{
	public function setUp()
	{
		$this->obj = new Foo();
	}

	public function test_doSomething()
	{
		$actual = $this->obj->doSomething();
		$expected = 'something';
		$this->assertEquals($expected, $actual);
	}
}
