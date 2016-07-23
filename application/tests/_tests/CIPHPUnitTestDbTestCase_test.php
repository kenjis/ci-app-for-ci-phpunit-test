<?php

/**
 * @group ci-phpunit-test
 */
class CIPHPUnitTestDbTestCase_test extends DbTestCase
{
	private $table = 'category';

	public function test_when_you_has_one_recored_in_database_then_you_can_see_one_record()
	{
		$this->db->truncate($this->table);

		$data = [
			'id' => 1,
			'name' => 'Book',
		];
		$this->hasInDatabase($this->table, $data);

		$this->seeNumRecords(1, $this->table);
	}

	public function test_you_dont_see_non_exsitent_record()
	{
		$this->db->truncate($this->table);

		$data = [
			'id' => 1,
			'name' => 'Book',
		];
		$this->db->insert($this->table, $data);

		$data = [
			'id' => 1,
			'name' => 'DVD',
		];
		$this->dontSeeInDatabase($this->table, $data);
	}

	public function test_you_can_see_record_in_database()
	{
		$this->db->truncate($this->table);

		$data = [
			'id' => 1,
			'name' => 'Book',
		];
		$this->db->insert($this->table, $data);

		$this->seeInDatabase($this->table, $data);
	}

	public function test_you_can_grab_from_database()
	{
		$CI =& get_instance();
		$CI->load->library('Seeder');
		$CI->seeder->call('CategorySeeder');

		$name = $this->grabFromDatabase($this->table, 'name', ['id' => 2]);
		$this->assertEquals('CD', $name);
	}
}
