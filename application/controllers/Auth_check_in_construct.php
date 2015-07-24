<?php

class Auth_check_in_construct extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('ion_auth');
		if ( ! $this->ion_auth->logged_in())
		{
			$this->load->helper('url');
			redirect('auth/login');
		}
	}

	public function index()
	{
		echo 'You are logged in.';
	}
}
