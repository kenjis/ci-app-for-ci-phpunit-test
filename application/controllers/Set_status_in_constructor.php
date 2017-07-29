<?php

class Set_status_in_constructor extends CI_Controller
{
	/** @var bool To indicate the routing to stop executing any functions because the startup failed already. */
	private $startup_failed = false;

	public function __construct()
	{
		parent::__construct();

		if (true)
		{  // some pre checks
			$this->output->set_status_header(404);
			echo('OH GAWD!');
			$this->startup_failed = true;
		}
	}

	public function _remap($object_called, $arguments = [])
	{
		if ($this->startup_failed)
		{
			return;
		}

		parent::_remap($object_called, $arguments);
	}
}
