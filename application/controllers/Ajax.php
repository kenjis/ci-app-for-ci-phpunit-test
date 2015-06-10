<?php

class Ajax extends CI_Controller
{
	public function index()
	{
		if ($this->input->is_ajax_request())
		{
			echo 'Ajax request';
		}
		else
		{
			echo 'Not Ajax request';
		}
	}
}
