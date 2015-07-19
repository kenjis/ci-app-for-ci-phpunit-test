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
		$output = $this->request('GET', ['Auth', 'index']);
		$this->assertContains('<p>Below is a list of the users.</p>', $output);
	}

	public function test_login_validation_fail()
	{
		$this->request->setCallable(
			function ($CI) {
				// Get mock object
				$validation = $this->getDouble(
					'CI_Form_validation',
					['set_rules' => NULL, 'run' => FALSE, 'set_value' => 'foo']
				);
				// Verify invocations
				$this->verifyInvokedMultipleTimes($validation, 'set_rules', 2);
				$this->verifyInvokedOnce($validation, 'run');
				$this->verifyNeverInvoked($validation, 'reset_validation');
				$this->verifyInvoked($validation, 'set_value', ['identity']);
				// Inject mock object
				$CI->form_validation = $validation;
			}
		);
		$output = $this->request('POST', 'auth/login');
		$this->assertContains('<p>Please login with your email/username and password below.</p>', $output);
	}

	/**
	 * @expectedException				PHPUnit_Framework_Exception
	 * @expectedExceptionCode			0
	 * @expectedExceptionMessageRegExp	!\ARedirect to .+/auth/login\z!
	 */
	public function test_login_validation_pass_but_login_fail()
	{
		$this->request->setCallable(
			function ($CI) {
				// Get mock object
				$validation = $this->getDouble(
					'CI_Form_validation',
					['set_rules' => NULL, 'run' => TRUE, 'set_value' => 'foo']
				);
				// Verify invocations
				$this->verifyInvokedMultipleTimes($validation, 'set_rules', 2);
				$this->verifyInvokedOnce($validation, 'run');
				$this->verifyNeverInvoked($validation, 'set_value');
				// Inject mock object
				$CI->form_validation = $validation;
			}
		);
		$output = $this->request('POST', 'auth/login');
	}
}
