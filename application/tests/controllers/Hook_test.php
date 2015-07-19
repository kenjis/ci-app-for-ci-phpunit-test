<?php

class Hook_test extends TestCase
{
	public function test_test()
	{
		$this->request->enableHooks();
		$output = $this->request('GET', 'hook/test');
		$this->assertRedirect('auth/login', 302);
	}
}
