<?php

class Hook_test extends TestCase
{
	/**
	 * @expectedException				PHPUnit_Framework_Exception
	 * @expectedExceptionCode			302
	 * @expectedExceptionMessageRegExp	!\ARedirect to .+/auth/login\z!
	 */
	public function test_test()
	{
		$this->request->enableHooks();
		$output = $this->request('GET', 'hook/test');
	}
}
