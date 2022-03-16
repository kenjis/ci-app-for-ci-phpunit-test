<?php

/**
 * @property CI_DB_pdo_sqlite_driver $db
 */
class Db_trans extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	public function index()
	{
		$this->db->trans_start();

		$this->db->trans_complete();

		if ($this->db->trans_status()) {
			echo 'Okay';
		} else {
			echo 'Error';
		}
	}
}
