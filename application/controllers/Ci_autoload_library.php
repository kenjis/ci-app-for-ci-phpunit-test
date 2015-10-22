<?php

class Ci_autoload_library extends CI_Controller
{
	public function subdir()
	{
		echo $this->baz->doSomething();
	}
}
