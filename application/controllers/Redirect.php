<?php

class Redirect extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');
		redirect('/');
	}
}
