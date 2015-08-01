<?php

class Patching_on_function extends CI_Controller
{
	public function index()
	{
		echo mt_rand(100, 999);
	}

	public function another()
	{
		echo mt_rand(1, 9);
	}

	public function passing_by_reference()
	{
		$count = 0;
		echo preg_replace(array('/\d/', '/\s/'), '*', 'xp 4 to', -1 , $count);
		echo "\n";
		echo $count;
	}
}
