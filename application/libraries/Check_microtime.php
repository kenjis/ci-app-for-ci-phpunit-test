<?php

class Check_microtime
{
	public static function exists()
	{
		return function_exists('microtime');
	}
}
