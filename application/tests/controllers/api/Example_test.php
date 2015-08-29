<?php

class Example_test extends TestCase
{
	public function test_users_get()
	{
		try {
			$output = $this->request('GET', 'api/example/users');
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}

		$this->assertEquals(
			'[{"id":1,"name":"John","email":"john@example.com","fact":"Loves coding"},{"id":2,"name":"Jim","email":"jim@example.com","fact":"Developed on CodeIgniter"},{"id":3,"name":"Jane","email":"jane@example.com","fact":"Lives in the USA","0":{"hobbies":["guitar","cycling"]}}]',
			$output
		);
		$this->assertResponseCode(200);
	}

	public function test_users_get_format_csv()
	{
		try {
			$output = $this->request('GET', 'api/example/users/format/csv');
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}

		$this->assertEquals(
			'id,name,email,fact
1,John,john@example.com,"Loves coding"
2,Jim,jim@example.com,"Developed on CodeIgniter"
3,Jane,jane@example.com,"Lives in the USA",Array
',
			$output
		);
		$this->assertResponseCode(200);
	}

	public function test_users_get_id()
	{
		$output = $this->request('GET', 'api/example/users/id/1');
		$this->assertEquals(
			'{"id":1,"name":"John","email":"john@example.com","fact":"Loves coding"}',
			$output
		);
		$this->assertResponseCode(200);
	}

	public function test_users_get_id_user_not_found()
	{
		$output = $this->request('GET', 'api/example/users/id/999');
		$this->assertEquals(
			'{"status":false,"error":"User could not be found"}',
			$output
		);
		$this->assertResponseCode(404);
	}
}
