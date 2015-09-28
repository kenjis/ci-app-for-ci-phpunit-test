<?php

class TestCase extends CIPHPUnitTestCase
{
	private static $migrate = false;

	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();

		// Run migrations once
		if (! self::$migrate)
		{
			$CI =& get_instance();
			$CI->load->database();
			$CI->load->library('migration');
			if ($CI->migration->current() === false) {
				throw new RuntimeException($this->migration->error_string());
			}

			self::$migrate = true;
		}
	}
}
