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
	}
}
