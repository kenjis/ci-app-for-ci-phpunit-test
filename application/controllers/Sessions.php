<?php

class Sessions extends CI_Controller
{
	public function super_global()
	{
		$_SESSION['test'] = 'super_global';
		echo $_SESSION['test'];
	}

	public function property()
	{
		$this->session->test = 'property';
		echo $this->session->test;
	}

	public function set_userdata()
	{
		$this->session->set_userdata('test', 'set_userdata');
		echo $this->session->test;
	}

	public function logged_in()
	{
		echo $this->session->logged_in;
	}
}
