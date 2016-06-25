<?php

require __DIR__ . '/Test_interface.php';

class Interface_test extends CI_Controller implements Test_interface
{
	public function test()
	{
		echo 'Okay';
	}
}
