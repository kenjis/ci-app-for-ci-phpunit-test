<?php

class Patching_on_constant extends CI_Controller
{
	public function index()
	{
		if (ENVIRONMENT === 'production')
		{
			echo 'This is production enviromnent.';
		}
		elseif (ENVIRONMENT === 'development')
		{
			echo 'This is development enviromnent.';
		}
		elseif (ENVIRONMENT === 'testing')
		{
			echo 'This is testing enviromnent.';
		}
	}

	public function no_classmethod()
    {
        define('CONST_FOR_JUST_TESTING', 'CONST_FOR_JUST_TESTING');
        echo CONST_FOR_JUST_TESTING;
    }
}
