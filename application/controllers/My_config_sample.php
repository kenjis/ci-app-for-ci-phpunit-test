<?php

class My_config_sample extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');
		echo site_url('testingtesting');
	}
}
