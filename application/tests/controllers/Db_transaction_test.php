<?php

class Db_transaction_test extends TestCase
{
	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();
		
		$CI =& get_instance();
		$CI->load->library('Seeder');
		$CI->seeder->call('CategorySeeder');
	}

	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->database();
		$this->db = $this->CI->load->database('default', TRUE);
		$this->db->trans_begin();
		$DB = $this->db;
		
		$this->request->setCallablePreConstructor(
			function () use ($DB) {
				// Inject db object
				load_class_instance('db', $DB);
			}
		);
	}

	public function tearDown()
	{
		$this->db->trans_rollback();
	}

	public function test_index()
	{
		$output = $this->request('GET', 'add_callable_pre_constructor');
		$this->assertContains(
			"Book\nCD\nDVD\nEbook\nSeminar\nWebminar\nsomething", $output
		);
	}

	public function test_list_category()
	{
		// Make sure the db transaction rolled back
		$output = $this->request('GET', 'add_callable_pre_constructor/list_category');
		$this->assertContains(
			"Book\nCD\nDVD\n", $output
		);
	}
}
