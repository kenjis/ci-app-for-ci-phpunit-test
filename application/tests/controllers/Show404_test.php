<?php

class Show404_test extends TestCase
{
	/**
	 * @expectedException		PHPUnit_Framework_Exception
	 * @expectedExceptionCode	404
	 */
	public function test_index()
	{
		$this->request('GET', 'show404');
	}
}
