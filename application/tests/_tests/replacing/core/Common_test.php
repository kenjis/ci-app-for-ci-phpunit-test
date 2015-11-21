<?php

/**
 * @group ci-phpunit-test
 */
class Replacing_Core_Common_test extends TestCase
{
	/**
	 * @expectedException CIPHPUnitTestExitException
	 * @expectedExceptionMessage Unable to locate the specified class: Xxxxx.php
	 */
	public function test_load_class_unable_to_locate()
	{
		load_class('Xxxxx');
	}
}
