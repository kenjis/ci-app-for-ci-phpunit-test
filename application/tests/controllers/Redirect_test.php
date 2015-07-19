<?php

class Redirect_test extends TestCase
{
	public function test_index()
	{
		$this->request('GET', ['Redirect', 'index']);
		$this->assertRedirect('/', 302);
	}

	public function test_index_uri()
	{
		$this->request('GET', 'redirect');
		$this->assertRedirect('/', 302);
	}

	public function test_refresh()
	{
		$this->request('GET', ['Redirect', 'refresh']);
		$this->assertRedirect('/', 200);
	}

	public function test_refresh_uri()
	{
		$this->request('GET', 'redirect/refresh');
		$this->assertRedirect('/', 200);
	}
}
