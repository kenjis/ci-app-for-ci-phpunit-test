<?php

/**
 * @group ci-phpunit-test
 */
class CIPHPUnitTestNullCodeIgniter_test extends TestCase
{
	/**
	 * @expectedException LogicException
	 * @expectedExceptionMessage CodeIgniter instance is not instantiated yet. You can't use `$this->load` at the moment. Please fix your test code.
	 */
	public function test_call()
	{
		$obj = new CIPHPUnitTestNullCodeIgniter();
		$obj->load->libary('foo');
	}
}
