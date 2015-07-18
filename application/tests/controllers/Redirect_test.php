<?php

class Redirect_test extends TestCase
{
	public function test_redirect_request_controller()
	{
		$this->setExpectedRedirect('/', 302);
		$this->request('GET', ['Redirect', 'index']);
	}

	public function test_rediret_request_uri()
	{
		$this->setExpectedRedirect('/', 302);
		$this->request('GET', 'redirect');
	}
}
