<?php

class MY_Loader_test extends TestCase
{
	public function test_testOfCIPHPUnitTest()
	{
		$CI =& get_instance();
		$actual = $CI->load->testOfCIPHPUnitTest();
		$expected = 'From MY_Loader';
		$this->assertEquals($expected, $actual);
	}
}