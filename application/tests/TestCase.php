<?php

class TestCase extends CIPHPUnitTestCase
{
	private static $migrate = false;

	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();
		
		// Run migration once
		if (! self::$migrate)
		{
			$CI =& get_instance();
			$CI->load->database();
			$CI->load->library('migration');
			$CI->migration->current();
		}
	}
}
