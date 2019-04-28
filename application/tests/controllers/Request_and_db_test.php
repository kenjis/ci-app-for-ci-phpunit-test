<?php
/**
 * Part of ci-phpunit-test
 *
 * @author	  Kenji Suzuki <https://github.com/kenjis>
 * @license	 MIT License
 * @copyright   2018 Kenji Suzuki
 * @link		https://github.com/kenjis/ci-phpunit-test
 */

class Request_and_db_test extends DbTestCase
{
	public static function setUpBeforeClass() : void
	{
		parent::setUpBeforeClass();

		$CI =& get_instance();
		$CI->load->library('Seeder');
		$CI->seeder->call('CategorySeeder');
	}

	public function test_index()
	{
		$this->request('GET', 'add_category');

		$data = [
			'name' => 'a_category_added_by_controller',
		];
		$this->seeInDatabase('category', $data);
	}
}
