<?php

class Download_test extends TestCase
{
	public function test_force_download()
	{
		$output = $this->request('GET', 'download/force_download');

		$this->assertResponseHeader(
			'Content-Disposition', 'attachment; filename="test.csv"'
		);
		
		$expected = "Header1,Header2,Header3\nData1,Data2,Data3\n";
		$this->assertEquals($expected, $output);
	}

	public function test_set_output()
	{
		$output = $this->request('GET', 'download/set_output');

		$this->assertResponseCode(200);
		$this->assertResponseHeader(
			'Content-Type', 'application/csv; charset=utf-8'
		);
		
		$expected = "Header1,Header2,Header3\nData1,Data2,Data3\n";
		$this->assertEquals($expected, $output);
	}
}
