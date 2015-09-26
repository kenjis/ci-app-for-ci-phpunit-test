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
		MonkeyPatch::verifyInvoked(
			'Category_model::get_category_list'
		);
		MonkeyPatch::verifyNeverInvoked(
			'Welcome::index'
		);
		$output = $this->request('GET', 'patching_on_method');
		$this->assertContains('Nothing', $output);
	}

	public function test_index_return_is_clouser()
	{
		MonkeyPatch::patchMethod(
			'Category_model',
			['get_category_list' => 
				function ($arg = null) {
					return $arg === null ? [(object) ['name' => 'Nothing']]
						: [(object) ['name' => 'Everything']];
				}
			]
		);
		MonkeyPatch::verifyInvokedOnce(
			'Category_model::get_category_list'
		);
		$output = $this->request('GET', 'patching_on_method');
		$this->assertContains('Nothing', $output);
	}

	public function test_index_return_null()
	{
		MonkeyPatch::patchMethod(
			'Patching_on_method',
			['index' => null]
		);
		MonkeyPatch::verifyInvokedOnce(
			'Patching_on_method::index'
		);
		$output = $this->request('GET', 'patching_on_method');
		$this->assertEquals('', $output);
	}

	public function test_auth()
	{
		MonkeyPatch::patchMethod(
			'Ion_auth_model',
			['login' => true]
		);

		MonkeyPatch::verifyInvoked(
			'Ion_auth_model::login', ['foo', 'bar']
		);
		MonkeyPatch::verifyInvokedOnce(
			'Ion_auth_model::login', ['foo', 'bar']
		);
		MonkeyPatch::verifyNeverInvoked(
			'Ion_auth_model::login', ['username', 'PHS/DL1m6OMYg']
		);
		MonkeyPatch::verifyInvokedOnce(
			'CI_Input::post', ['id']
		);
		MonkeyPatch::verifyInvokedOnce(
			'CI_Input::post', ['password']
		);
		MonkeyPatch::verifyInvokedMultipleTimes(
			'CI_Input::post', 2
		);

		$output = $this->request(
			'POST', 'patching_on_method/auth',
			['id' => 'foo', 'password' => 'bar']
		);
		$this->assertContains('Okay!', $output);
	}
}
