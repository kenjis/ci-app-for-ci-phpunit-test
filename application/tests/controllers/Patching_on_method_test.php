<?php

/**
 * @group patcher
 */
class Patching_on_method_test extends TestCase
{
	public function test_index_return_is_array()
	{
		MonkeyPatch::patchMethod(
			'Category_model',
			['get_category_list' => [(object) ['name' => 'Nothing']]]
		);
		MonkeyPatch::verifyInvokedMultipleTimes(
			'Category_model::get_category_list', 1
		);
		MonkeyPatch::verifyInvokedMultipleTimes(
			'Welcome::index', 0
		);
		$output = $this->request('GET', 'patching_on_method');
		$this->assertContains('Nothing', $output);
	}

	public function test_index_return_is_clouser()
	{
		MonkeyPatch::patchMethod(
			'Category_model',
			['get_category_list' => 
				function ($arg) {
					return $arg === null ? [(object) ['name' => 'Nothing']]
						: [(object) ['name' => 'Everything']];
				}
			]
		);
		MonkeyPatch::verifyInvokedMultipleTimes(
			'Category_model::get_category_list', 1
		);
		$output = $this->request('GET', 'patching_on_method');
		$this->assertContains('Nothing', $output);
	}

	public function test_auth()
	{
		MonkeyPatch::patchMethod(
			'Ion_auth_model',
			['login' => true]
		);
		MonkeyPatch::verifyInvokedMultipleTimes(
			'Ion_auth_model::login', 1, ['foo', 'bar']
		);
		MonkeyPatch::verifyInvokedMultipleTimes(
			'CI_Input::post', 1, ['id']
		);
		MonkeyPatch::verifyInvokedMultipleTimes(
			'CI_Input::post', 1, ['password']
		);
		$output = $this->request(
			'POST', 'patching_on_method/auth',
			['id' => 'foo', 'password' => 'bar']
		);
		$this->assertContains('Okay!', $output);
	}
}
