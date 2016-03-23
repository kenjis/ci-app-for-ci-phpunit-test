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

	public function external()
	{
		$this->load->helper('url');
		redirect('http://www.example.com');
	}

	public function refresh_external()
	{
		$this->load->helper('url');
		redirect('http://www.example.com', 'refresh');
	}
}
