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
}
