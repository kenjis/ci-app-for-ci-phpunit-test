<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Status_code_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'status_code');
		$this->assertEquals('', $output);
		$this->assertResponseCode(400);
	}
}
