<?php

class Header extends CI_Controller
{
	public function good_coding()
	{
		$encoding = strtolower($this->config->item('charset'));
		$this->output->set_header("Content-type: application/json; charset=$encoding", true, 200 );
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");	// Date in the past
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	// always modified
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");	// HTTP/1.1
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache");

		echo 'test';
	}

	public function bad_coding()
	{
		$encoding = strtolower($this->config->item('charset'));
		header("Content-type: application/json; charset=$encoding", true, 200 );
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");	// Date in the past
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	// always modified
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");	// HTTP/1.1
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		echo 'test';
	}
}
