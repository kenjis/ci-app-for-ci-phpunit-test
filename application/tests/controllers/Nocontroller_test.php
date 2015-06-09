<?php

class Nocontroller_test extends TestCase
{
	/**
	 * @expectedException		PHPUnit_Framework_Exception
	 * @expectedExceptionCode	404
	 */
	public function test_method_404()
	{
		$output = $this->request('GET', ['nocontroller', 'nomethod']);
	}

	/**
	 * @expectedException		PHPUnit_Framework_Exception
	 * @expectedExceptionCode	404
	 */
	public function test_uri_404()
	{
		$output = $this->request('GET', 'nocontroller/nomethod');
	}
}
