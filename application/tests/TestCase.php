<?php

class TestCase extends CIPHPUnitTestCase
{
	public static $enable_patcher = true;

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
