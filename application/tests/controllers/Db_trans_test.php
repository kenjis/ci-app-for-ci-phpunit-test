<?php

class Db_trans_test extends TestCase
{
	public function test_index()
	{
		$this->request->addCallable(function ($CI) {
			$db = $this->getMockBuilder('CI_DB_pdo_sqlite_driver')
					->disableOriginalConstructor()
					->setMethods([
						'trans_status',
						'trans_start',
					])
					->getMock();
			$db->method('trans_status')->willReturn(false);
			$db->method('trans_start')->willReturn(true);
			$CI->db = $db;
		});

		$output = $this->request('GET', 'db_trans');

		$this->assertSame('Error', $output);
	}
}
