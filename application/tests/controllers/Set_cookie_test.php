<?php

class Set_cookie_test extends TestCase
{
	public function test_all_params()
	{
		$output = $this->request('GET', 'set_cookie/all_params');
		$this->assertResponseCookie(
			'myprefix_The-Cookie-Name', 'The Value'
		);

		$cookie = [
			'value'  => 'The Value',
			'domain' => '.example.com',
			'path'   => '/',
			'secure' => TRUE,
			'httponly' => FALSE,
		];
		$this->assertResponseCookie(
			'myprefix_The-Cookie-Name', $cookie
		);
	}

	public function test_name_and_value()
	{
		$output = $this->request('GET', 'set_cookie/name_and_value');
		$this->assertResponseCookie(
			'The-Cookie-Name', 'The Value'
		);

		$cookie = [
			'value'  => 'The Value',
			'domain' => '',
			'path'   => '/',
			'secure' => FALSE,
			'httponly' => FALSE,
		];
		$this->assertResponseCookie(
			'The-Cookie-Name', $cookie
		);
	}

	public function test_cookie_is_just_set()
	{
		$output = $this->request('GET', 'set_cookie/name_and_value');
		$this->assertResponseCookie(
			'The-Cookie-Name', $this->anything()
		);
	}

	public function test_twice()
	{
		$output = $this->request('GET', 'set_cookie/twice');
		$this->assertResponseCookie(
			'The-Cookie-Name', 'The 2nd Value', TRUE
		);

		$cookie = [
			'value'  => 'The 2nd Value',
			'domain' => '',
			'path'   => '/',
			'secure' => FALSE,
			'httponly' => FALSE,
		];
		$this->assertResponseCookie(
			'The-Cookie-Name', $cookie, TRUE
		);
	}
}
