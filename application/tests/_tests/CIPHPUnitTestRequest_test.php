<?php

/**
 * @group ci-phpunit-tests
 */
class CIPHPUnitTestRequest_test extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException LogicException
	 * @expectedExceptionMessage Status code is not set
	 */
	public function test_getStatus()
	{
		$obj = new CIPHPUnitTestRequest($this);
		$obj->getStatus();
	}
}
