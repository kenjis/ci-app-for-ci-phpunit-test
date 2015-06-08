<?php

class Remap extends CI_Controller
{
	public function _remap($method)
	{
		if ($method === 'some_method') {
			$this->another();
		} else {
			$this->index();
		}
	}

	public function index()
	{
		echo 'index';
	}

	public function another()
	{
		echo 'another';
	}
}
