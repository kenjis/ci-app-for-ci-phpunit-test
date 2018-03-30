<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class CodeIgniterTestingGuideSeeder extends Seeder {

	private $table = 'favorite_detail';

	public function __construct()
	{
		parent::__construct();
		$this->depends = [
			APPPATH.'database/seeds' => 'FavoriteSeeder',
			APPPATH.'database/seeds/FavoriteDetail' => [
				'FavoriteDetailsClearSeeder',
				'CodeIgniterTetteiNyumonSeeder'
			]
		];
	}

	public function run()
	{
		$data = [
			'id' => 1,
			'retailer_url' => 'https://leanpub.com/codeigniter-testing-guide',
		];
		$this->db->insert($this->table, $data);
	}

}
