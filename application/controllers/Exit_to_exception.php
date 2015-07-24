<?php

class Exit_to_exception extends CI_Controller
{
	public function call_exit_in_controller_method()
	{
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode(['foo' => 'bar']))
			->_display();
		exit();
	}

	public function call_exit_in_function()
	{
		echo 'You can not access this page!';
		die_test();
	}
}

function die_test()
{
	die('Bye!');
}
