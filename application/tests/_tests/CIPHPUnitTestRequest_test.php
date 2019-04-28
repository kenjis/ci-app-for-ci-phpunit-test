<?php

/**
 * @group ci-phpunit-test
 */
class CIPHPUnitTestRequest_test extends TestCase
{
	public function test_getStatus()
	{
		$this->expectException(LogicException::class);
		$this->expectExceptionMessage('Status code is not set');

		$obj = new CIPHPUnitTestRequest($this);
		$obj->getStatus();
	}
}
