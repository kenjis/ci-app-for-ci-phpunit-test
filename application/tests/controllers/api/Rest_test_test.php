<?php

/**
 * @group patcher
 */
class Rest_test_test extends TestCase
{
	public function test_index_get()
	{
		set_is_cli(FALSE);
		$this->warningOff();
		try {
			$output = $this->request(
				'GET', 'api/rest_test?name=John%20O%27reilly&city=Tokyo'
			);
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}
		set_is_cli(TRUE);
		$this->warningOn();

		$expected = <<< 'EOL'
{"get":{"name":"John O'reilly","city":"Tokyo"},"query":{"name":"John O'reilly","city":"Tokyo"}}
EOL;
		$this->assertEquals($expected, $output);
		$this->assertResponseCode(200);
	}

	public function test_index_post()
	{
		set_is_cli(FALSE);
		$this->warningOff();
		try {
			$output = $this->request(
				'POST', 'api/rest_test?name=John%20O%27reilly&city=Tokyo',
				[
					'id' => 'abc',
					'password' => 'xyz'
				]
			);
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}
		set_is_cli(TRUE);
		$this->warningOn();

		$expected = <<< 'EOL'
{"post":{"id":"abc","password":"xyz"},"query":{"name":"John O'reilly","city":"Tokyo"}}
EOL;
		$this->assertEquals($expected, $output);
		$this->assertResponseCode(200);
	}

	public function test_index_put()
	{
		set_is_cli(FALSE);
		$this->warningOff();
		try {
			$output = $this->request(
				'PUT', 'api/rest_test?name=John%20O%27reilly&city=Tokyo',
				'id=abc&password=xyz'
			);
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}
		set_is_cli(TRUE);
		$this->warningOn();

		$expected = <<< 'EOL'
{"put":{"id":"abc","password":"xyz"},"query":{"name":"John O'reilly","city":"Tokyo"}}
EOL;
		$this->assertEquals($expected, $output);
		$this->assertResponseCode(200);
	}

	public function test_index_delete()
	{
		set_is_cli(FALSE);
		$this->warningOff();
		try {
			$output = $this->request(
				'DELETE', 'api/rest_test?name=John%20O%27reilly&city=Tokyo',
				'id=abc&password=xyz'
			);
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}
		set_is_cli(TRUE);
		$this->warningOn();

		$expected = <<< 'EOL'
{"delete":{"id":"abc","password":"xyz"},"query":{"name":"John O'reilly","city":"Tokyo"}}
EOL;
		$this->assertEquals($expected, $output);
		$this->assertResponseCode(200);
	}
}
