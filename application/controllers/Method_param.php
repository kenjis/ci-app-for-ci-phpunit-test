<?php

class Method_param extends CI_Controller
{
	public function index($param1, $param2)
	{
		echo html_escape('param1: ' . $param1 . ' param2: ' . $param2);
	}
}
