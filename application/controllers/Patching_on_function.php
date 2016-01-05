<?php

class Patching_on_function extends CI_Controller
{
	public function index()
	{
		echo mt_rand(100, 999);
	}

	public function another()
	{
		echo mt_rand(1, 9);
	}

	public function openssl_random_pseudo_bytes()
	{
		$bytes = openssl_random_pseudo_bytes(4, $cstrong);
		$hex   = bin2hex($bytes);
		echo "$hex\n";
		echo "$cstrong\n";
	}

	public function function_exists()
	{
		if (function_exists('random_bytes'))
		{
			echo 'I use random_bytes().';
		}
		elseif (function_exists('openssl_random_pseudo_bytes'))
		{
			echo 'I use openssl_random_pseudo_bytes().';
		}
		elseif (function_exists('mcrypt_create_iv'))
		{
			echo 'I use mcrypt_create_iv().';
		}
		else {
			echo 'I use mt_rand().';
		}

		if (! function_exists('exit'))
		{
			echo ' Do you know? There is no exit() function in PHP.';
		}
	}

	public function scope_limitation_method()
	{
		if (function_exists('microtime'))
		{
			echo 'I have microtime().';
		}
		else
		{
			echo 'I don\'t have microtime().';
		}

		echo ' ';
		$this->check_microtime();

		$this->load->library('check_microtime');
		echo ' ';
		if ($this->check_microtime->exists('microtime'))
		{
			echo 'I have microtime().';
		}
		else
		{
			echo 'I don\'t have microtime().';
		}
	}

	public function scope_limitation_class()
	{
		if (function_exists('microtime'))
		{
			echo 'I have microtime().';
		}
		else
		{
			echo 'I don\'t have microtime().';
		}

		echo ' ';
		$this->check_microtime();

		$this->load->library('check_microtime');
		echo ' ';
		if ($this->check_microtime->exists('microtime'))
		{
			echo 'I have microtime().';
		}
		else
		{
			echo 'I don\'t have microtime().';
		}
	}

	protected function check_microtime()
	{
		if (function_exists('microtime'))
		{
			echo 'I have microtime().';
		}
		else
		{
			echo 'I don\'t have microtime().';
		}
	}

	public function header()
	{
		header('Location: http://www.example.com/');
		echo 'call header()';
	}

	public function setcookie()
	{
		setcookie('TestCookie', 'something from somewhere');
		echo 'call setcookie()';
	}
}
