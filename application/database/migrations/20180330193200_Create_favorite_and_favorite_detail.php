<?php
/**
 * Migration: Create_favorite_and_favorite_detail
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2018/03/30 19:32:00
 */
class Migration_Create_favorite_and_favorite_detail extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			),
			'category_id' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 64,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('favorite');

		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'retailer_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('favorite_detail');
	}

	public function down()
	{
		$this->dbforge->drop_table('favorite');
		$this->dbforge->drop_table('favorite_detail');
	}

}
