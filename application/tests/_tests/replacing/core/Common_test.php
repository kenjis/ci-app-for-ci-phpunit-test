<?php

/**
 * @group ci-phpunit-test
 */
class Replacing_Core_Common_test extends TestCase
{
	public function test_load_class_unable_to_locate()
	{
		$this->expectException(CIPHPUnitTestExitException::class);
		$this->expectExceptionMessage('Unable to locate the specified class: Xxxxx.php');

		load_class('Xxxxx');
	}
}
