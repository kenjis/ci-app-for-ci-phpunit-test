<?php

class Add_callable_pre_constructor_test extends TestCase
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
		$CI =& get_instance();
		$this->db = $CI->load->database('default', TRUE);
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

		parent::tearDown();
	}

	public function test_index()
	{
		$foo = new Foo();

		// If you want to add another callable
		$this->request->addCallablePreConstructor(
			function () use ($foo) {
				// Inject foo object
				load_class_instance('foo', $foo);
			}
		);

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
