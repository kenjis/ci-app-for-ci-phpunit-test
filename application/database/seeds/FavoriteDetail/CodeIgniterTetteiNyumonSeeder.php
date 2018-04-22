<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class CodeIgniterTetteiNyumonSeeder extends Seeder {

	private $table = 'favorite_detail';

	public function run()
	{
		$data = [
			'id' => 2,
			'retailer_url' => 'https://www.amazon.co.jp/CodeIgniter%E5%BE%B9%E5%BA%95%E5%85%A5%E9%96%80-%E6%B2%B3%E5%90%88-%E5%8B%9D%E5%BD%A6/dp/4798116769',
		];
		$this->db->insert($this->table, $data);
	}

}
