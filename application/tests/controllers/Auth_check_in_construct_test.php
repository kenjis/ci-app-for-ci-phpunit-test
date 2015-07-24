<?php

class Auth_check_in_construct_test extends TestCase
{
	public function test_index_not_logged_in()
	{
		// This request is redirected to '/auth/login'
		$this->request('GET', 'auth_check_in_construct');
		$this->assertRedirect('auth/login');
	}

	public function test_index_logged_in()
	{
		$this->request->setCallablePreConstructor(
			function () {
				// Get mock object
				$auth = $this->getDouble(
					'Ion_auth', ['logged_in' => TRUE]
				);
				// Inject mock object
				load_class_instance('ion_auth', $auth);
			}
		);

		$output = $this->request('GET', 'auth_check_in_construct');
		$this->assertContains('You are logged in.', $output);
	}
}
