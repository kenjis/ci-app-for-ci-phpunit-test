<?php

class Assign_to_config extends CI_Controller
{
	public function index()
	{
		echo config_item('name_of_config_item');
	}
}
