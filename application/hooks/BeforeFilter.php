<?php

class BeforeFilter
{
	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	function test()
	{
		if ($this->CI->uri->uri_string() === 'hook/test')
		{
			$this->CI->load->helper('url');
			redirect('auth/login');
		}
	}
}
