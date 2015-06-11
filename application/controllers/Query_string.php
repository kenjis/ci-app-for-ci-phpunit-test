<?php

class Query_string extends CI_Controller
{
	public function index()
	{
		$name = $this->input->get('name');
		echo html_escape($name) . ', you sent Query string!';
	}
}
