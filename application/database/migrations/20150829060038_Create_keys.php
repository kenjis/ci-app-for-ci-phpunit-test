<?php

class Migration_Create_keys extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			),
			'key' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
			),
			'level' => array(
				'type' => 'INT',
				'constraint' => 2,
			),
			'ignore_limits' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0,
			),
			'date_created' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('keys');
	}

	public function down()
	{
		$this->dbforge->drop_table('keys');
	}

}
