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
	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();

		$CI =& get_instance();
		$CI->load->library('Seeder');
		$CI->seeder->call('CategorySeeder');
	}

	public function test_index()
	{
		$this->request('GET', 'Add_category');

		// I don't know why, but the moment, $this->db->conn_id is null.
		// So I have to reconnect to the database. If not, I have the error:
		//   Error: Call to a member function quote() on boolean
		$this->reconnectDb();

		$data = [
			'name' => 'a_category_added_by_controller',
		];
		$this->seeInDatabase('category', $data);
	}
}
