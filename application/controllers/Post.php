<?php

class Post extends CI_Controller
{
	public function index()
	{
		if ($this->input->method() !== 'post')
		{
			show_404('Not Found');
		}
		
		$name = $this->input->post('name');
		echo html_escape($name) . ', you sent POST request!';
	}
}
