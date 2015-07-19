<?php

class Redirect extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');
		redirect('/');
	}

	public function refresh()
	{
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}
