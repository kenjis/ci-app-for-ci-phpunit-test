<?php

class Redirect_test extends TestCase
{
	/**
	 * @expectedException				PHPUnit_Framework_Exception
	 * @expectedExceptionCode			302
	 * @expectedExceptionMessageRegExp	!\ARedirect to .+/\z!
	 */
	public function test_index()
	{
		$output = $this->request('GET', ['Redirect', 'index']);
	}

	/**
	 * @expectedException				PHPUnit_Framework_Exception
	 * @expectedExceptionCode			302
	 * @expectedExceptionMessageRegExp	!\ARedirect to .+/\z!
	 */
	public function test_uri_rediret()
	{
		$output = $this->request('GET', 'redirect');
	}
}
