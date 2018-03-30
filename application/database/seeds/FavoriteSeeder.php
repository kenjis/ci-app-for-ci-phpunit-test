<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class FavoriteSeeder extends Seeder {

	private $table = 'favorite';

	protected $depends = ['CategorySeeder'];

	public function run()
	{
		$this->db->truncate($this->table);

		$data = [
			'id' => 1,
			'category_id' => 1,
			'name' => 'CodeIgniter Testing Guide',
		];
		$this->db->insert($this->table, $data);

		$data = [
			'id' => 2,
			'category_id' => 1,
			'name' => 'CodeIgniter tettei nyumon',
		];
		$this->db->insert($this->table, $data);
	}

}
