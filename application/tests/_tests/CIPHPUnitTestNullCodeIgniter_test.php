<?php

/**
 * @group ci-phpunit-test
 */
class CIPHPUnitTestNullCodeIgniter_test extends TestCase
{
	public function test_call()
	{
		$this->expectException(LogicException::class);
		$this->expectExceptionMessage('CodeIgniter instance is not instantiated yet. You can\'t use `$this->load` at the moment. Please fix your test code.');

		$obj = new CIPHPUnitTestNullCodeIgniter();
		$obj->load->libary('foo');
	}
}
