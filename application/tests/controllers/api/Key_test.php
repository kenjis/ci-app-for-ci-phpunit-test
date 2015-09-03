<?php

/**
 * @group patcher
 */
class Key_test extends TestCase
{
	private static $key;

	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->truncate('keys');
	}

	public function setUp()
	{
		$this->request->setCallable(
			function ($CI) {
				$CI->load->database();
			}
		);
	}

	public function test_index_put()
	{
		try {
			$output = $this->request('PUT', 'api/key/index');
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}
		$response = json_decode($output);

		$this->assertTrue($response->status);
		$this->assertResponseCode(201);

		self::$key = $response->key;
	}

	public function test_level_post()
	{
		try {
			$output = $this->request(
				'POST', 'api/key/level', ['key' => self::$key, 'level' => 10]
			);
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}
		$response = json_decode($output);

		$this->assertTrue($response->status);
		$this->assertEquals('API key was updated', $response->success);
		$this->assertResponseCode(200);
	}

	public function test_index_delete_key_not_exist()
	{
		try {
			$output = $this->request('DELETE', 'api/key/index');
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}
		$response = json_decode($output);

		$this->assertFalse($response->status);
		$this->assertResponseCode(400);
	}

	public function test_index_delete_key()
	{
//		$this->request->setCallablePreConstructor(
//			function () {
//				$INPUT =& load_class('Input', 'core');
//				ReflectionHelper::setPrivateProperty(
//					$INPUT,
//					'_raw_input_stream',
//					'key='.self::$key
//				);
//			}
//		);

		try {
			$output = $this->request(
				'DELETE', 'api/key/index', 'key='.self::$key
			);
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}
		$response = json_decode($output);

		$this->assertTrue($response->status);
		$this->assertResponseCode(204);
	}
}
