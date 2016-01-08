<?php

class Set_cookie extends CI_Controller
{
	public function all_params()
	{
		$cookie = [
			'name'   => 'The-Cookie-Name',
			'value'  => 'The Value',
			'expire' => '86500',
			'domain' => '.example.com',
			'path'   => '/',
			'prefix' => 'myprefix_',
			'secure' => TRUE
		];
		$this->input->set_cookie($cookie);
		var_dump(headers_list());
	}

	public function name_and_value()
	{
		$cookie = [
			'name'   => 'The-Cookie-Name',
			'value'  => 'The Value',
		];
		$this->input->set_cookie($cookie);
		var_dump(headers_list());
	}

	public function twice()
	{
		$cookie = [
			'name'   => 'The-Cookie-Name',
			'value'  => 'The 1st Value',
		];
		$this->input->set_cookie($cookie);
		$cookie = [
			'name'   => 'The-Cookie-Name',
			'value'  => 'The 2nd Value',
		];
		$this->input->set_cookie($cookie);
		var_dump(headers_list());
	}
}
