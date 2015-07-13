<?php

class Auth_test extends TestCase
{
	/**
	 * @expectedException				PHPUnit_Framework_Exception
	 * @expectedExceptionCode			0
	 * @expectedExceptionMessageRegExp	!\ARedirect to .+/auth/login\z!
	 */
	public function test_index()
	{
		// This request is redirected to '/auth/login'
		$output = $this->request('GET', ['Auth', 'index']);
	}

	public function test_index_logged_in()
	{
		$this->request->setCallable(
			function ($CI) {
				// Get mock object
				$auth = $this->getDouble(
					'Ion_auth', ['logged_in' => TRUE, 'is_admin' => TRUE]
				);
				// Inject mock object
				$CI->ion_auth = $auth;
			}
		);
		$output = $this->request('GET', ['Auth', 'index'], []);
		$this->assertContains('<p>Below is a list of the users.</p>', $output);
	}
}
