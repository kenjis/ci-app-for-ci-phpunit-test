<?php

class Status_code extends CI_Controller
{
	public function index()
	{
		$this->output->set_status_header(400);
	}
}
