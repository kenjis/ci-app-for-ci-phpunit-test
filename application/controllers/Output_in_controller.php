<?php

class Output_in_controller extends CI_Controller
{
	public function index()
	{
		$this->output->set_output('bra bra bra');
	}

	public function _output($output)
	{
		echo html_escape('$output is "' . $output . '"');
	}
}
