<?php

class Cli extends CI_Controller
{
	public function index()
	{
		if (is_cli())
		{
			echo 'You can not run this via CLI';
			exit;
		}
		
		echo 'Okay';
	}
}
