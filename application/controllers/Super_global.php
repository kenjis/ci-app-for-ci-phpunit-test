<?php

class Super_global extends CI_Controller
{
	public function index()
	{
		echo '<pre>' . "\n";
		
		ob_start();
		var_export($_GET);
		$get = ob_get_clean();
		echo '$_GET: ' . $get;
		echo "\n";
		
		ob_start();
		var_export($_POST);
		$post = ob_get_clean();
		echo '$_POST: ' . $post;
		echo "\n";
		
		ob_start();
		var_export($_COOKIE);
		$cookie = ob_get_clean();
		echo '$_COOKIE: ' . $cookie;
		echo "\n";
		
		ob_start();
		var_export($_SESSION);
		$session = ob_get_clean();
		echo '$_SESSION: ' . $session;
		echo "\n";
		
		ob_start();
		var_export($_SERVER);
		$server = ob_get_clean();
		echo '$_SERVER: ' . $server;
		echo "\n";
		
		echo '</pre>' . "\n";
	}
}
