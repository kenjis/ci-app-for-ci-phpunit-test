<?php

class Exit_to_exception extends CI_Controller
{
	public function index()
	{
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode(['foo' => 'bar']))
			->_display();
		exit();
	}
}
