<?php
/**
 * Migration: Create_category
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2015/05/12 06:00:38
 */
class Migration_Create_category extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 64,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('category');
	}

	public function down()
	{
		$this->dbforge->drop_table('category');
	}

}
