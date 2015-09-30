<?php

class Errors extends CI_Controller
{
	public function page_missing()
	{
		$this->output->set_status_header(404);
		$this->load->view(
			'errors/html/error_404',
			[
				'heading' => '404 Not Found',
				'message' => '<p>The page you requested was not found.</p>',
			]
		);
	}
}
