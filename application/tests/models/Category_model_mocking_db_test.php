<?php

class Category_model_mocking_db_test extends TestCase
{
	public function setUp()
	{
		$this->obj = $this->newModel('Category_model');
	}

	public function test_get_category_list()
	{
		// Create mock objects for CI_DB_pdo_result and CI_DB_pdo_sqlite_driver
		$return = [
			0 => (object) ['id' => '1', 'name' => 'Book'],
			1 => (object) ['id' => '2', 'name' => 'CD'],
			2 => (object) ['id' => '3', 'name' => 'DVD'],
		];
		$db_result = $this->getMockBuilder('CI_DB_pdo_result')
			->disableOriginalConstructor()
			->getMock();
		$db_result->method('result')->willReturn($return);
		$db = $this->getMockBuilder('CI_DB_pdo_sqlite_driver')
			->disableOriginalConstructor()
			->getMock();
		$db->method('get')->willReturn($db_result);
		
		// Verify invocations
		$this->verifyInvokedOnce(
			$db_result,
			'result',
			[]
		);
		$this->verifyInvokedOnce(
			$db,
			'order_by',
			['id']
		);
		$this->verifyInvokedOnce(
			$db,
			'get',
			['category']
		);

		// Replace property db with mock object
		$this->obj->db = $db;

		$expected = [
			1 => 'Book',
			2 => 'CD',
			3 => 'DVD',
		];
		$list = $this->obj->get_category_list();
		foreach ($list as $category) {
			$this->assertEquals($expected[$category->id], $category->name);
		}
	}
}
