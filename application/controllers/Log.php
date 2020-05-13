<?php

class Log extends CI_Controller
{
	public function index()
	{
		log_message('error', 'This is an error.');
	}
}
