<?php

/**
 * @group patcher
 */
class Patching_on_function_test extends TestCase
{
	public function test_index_patch_on_mt_rand()
	{
		MonkeyPatch::patchFunction('mt_rand', 100, 'Patching_on_function');
		$output = $this->request('GET', 'patching_on_function');
		$this->assertContains('100', $output);
	}

	public function test_index_patch_on_mt_rand_return_null()
	{
		MonkeyPatch::patchFunction('mt_rand', null, 'Patching_on_function');
		$output = $this->request('GET', 'patching_on_function');
		$this->assertEquals('', $output);
	}

	public function test_another_patch_on_mt_rand()
	{
		MonkeyPatch::patchFunction(
			'mt_rand',
			function($a, $b) {
				return $a . $b;
			},
			'Patching_on_function'
		);
		$output = $this->request('GET', 'patching_on_function/another');
		$this->assertContains('19', $output);
	}

	public function test_openssl_random_pseudo_bytes()
	{
		MonkeyPatch::patchFunction(
			'openssl_random_pseudo_bytes',
			'aaaa',
			'Patching_on_function'
		);
		$output = $this->request(
			'GET', 'patching_on_function/openssl_random_pseudo_bytes'
		);
		$this->assertEquals("61616161\n1\n", $output);
	}

	public function test_openssl_random_pseudo_bytes_without_2nd_arg()
	{
		MonkeyPatch::patchFunction(
			'openssl_random_pseudo_bytes',
			'aaaa',
			'Patching_on_function'
		);
		$output = $this->request(
			'GET', 'patching_on_function/openssl_random_pseudo_bytes_without_2nd_arg'
		);
		$this->assertEquals("61616161\n", $output);
	}

	public function test_openssl_random_pseudo_bytes_null()
	{
		MonkeyPatch::patchFunction(
			'openssl_random_pseudo_bytes',
			null,
			'Patching_on_function'
		);
		$output = $this->request(
			'GET', 'patching_on_function/openssl_random_pseudo_bytes'
		);
		$this->assertEquals("\n1\n", $output);
	}

	public function test_openssl_random_pseudo_bytes_callable()
	{
		MonkeyPatch::patchFunction(
			'openssl_random_pseudo_bytes',
			function ($int, &$crypto_strong) {
				$crypto_strong = false;
				return 'bbbb';
			},
			'Patching_on_function'
		);
		$output = $this->request(
			'GET', 'patching_on_function/openssl_random_pseudo_bytes'
		);
		$this->assertEquals("62626262\n\n", $output);
	}

	public function test_function_exists_use_random_bytes()
	{
		MonkeyPatch::patchFunction(
			'function_exists',
			function ($function) {
				if ($function === 'random_bytes')
				{
					return true;
				}
				elseif ($function === 'openssl_random_pseudo_bytes')
				{
					return false;
				}
				elseif ($function === 'mcrypt_create_iv')
				{
					return false;
				}
				else
				{
					return __GO_TO_ORIG__;
				}
			},
			'Patching_on_function'
		);

		MonkeyPatch::verifyInvokedOnce('function_exists', ['random_bytes']);
		MonkeyPatch::verifyInvokedOnce('function_exists', ['exit']);
		MonkeyPatch::verifyInvokedMultipleTimes('function_exists', 2);
		MonkeyPatch::verifyNeverInvoked('function_exists', ['openssl_random_pseudo_bytes']);
		MonkeyPatch::verifyNeverInvoked('function_exists', ['mcrypt_create_iv']);

		$output = $this->request(
			'GET', 'patching_on_function/function_exists'
		);
		$this->assertContains("I use random_bytes().", $output);
		$this->assertContains("Do you know? There is no exit() function in PHP.", $output);
	}

	public function test_function_exists_use_openssl_random_pseudo_bytes()
	{
		MonkeyPatch::patchFunction(
			'function_exists',
			function ($function) {
				if ($function === 'random_bytes')
				{
					return false;
				}
				elseif ($function === 'openssl_random_pseudo_bytes')
				{
					return true;
				}
				elseif ($function === 'mcrypt_create_iv')
				{
					return false;
				}
				else
				{
					return __GO_TO_ORIG__;
				}
			},
			'Patching_on_function'
		);
		$output = $this->request(
			'GET', 'patching_on_function/function_exists'
		);
		$this->assertContains("I use openssl_random_pseudo_bytes().", $output);
		$this->assertContains("Do you know? There is no exit() function in PHP.", $output);
	}

	public function test_function_exists_use_mcrypt_create_iv()
	{
		MonkeyPatch::patchFunction(
			'function_exists',
			function ($function) {
				if ($function === 'random_bytes')
				{
					return false;
				}
				elseif ($function === 'openssl_random_pseudo_bytes')
				{
					return false;
				}
				elseif ($function === 'mcrypt_create_iv')
				{
					return true;
				}
				else
				{
					return __GO_TO_ORIG__;
				}
			},
			'Patching_on_function'
		);
		$output = $this->request(
			'GET', 'patching_on_function/function_exists'
		);
		$this->assertContains("I use mcrypt_create_iv().", $output);
		$this->assertContains("Do you know? There is no exit() function in PHP.", $output);
	}

	public function test_scope_limitation_method()
	{
		MonkeyPatch::patchFunction(
			'function_exists',
			false,
			'Patching_on_function::scope_limitation_method'
		);

		$output = $this->request(
			'GET', 'patching_on_function/scope_limitation_method'
		);
		$this->assertEquals(
			"I don't have microtime(). I have microtime(). I have microtime().",
			$output
		);
	}

	public function test_scope_limitation_class()
	{
		MonkeyPatch::patchFunction(
			'function_exists',
			false,
			'Patching_on_function'
		);

		$output = $this->request(
			'GET', 'patching_on_function/scope_limitation_class'
		);
		$this->assertEquals(
			"I don't have microtime(). I don't have microtime(). I have microtime().",
			$output
		);
	}

	public function test_header()
	{
		MonkeyPatch::patchFunction(
			'header', null, 'Patching_on_function::header'
		);
		$output = $this->request('GET', 'patching_on_function/header');
		MonkeyPatch::verifyInvokedOnce(
			'header', ['Location: http://www.example.com/']
		);
		$this->assertEquals('call header()', $output);
	}

	public function test_setcookie()
	{
		MonkeyPatch::patchFunction(
			'setcookie', true, 'Patching_on_function::setcookie'
		);
		$output = $this->request('GET', 'patching_on_function/setcookie');
		MonkeyPatch::verifyInvokedOnce(
			'setcookie', ['TestCookie', 'something from somewhere']
		);
		$this->assertEquals('call setcookie()', $output);
	}
}
