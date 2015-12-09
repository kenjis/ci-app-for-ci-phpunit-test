<?php

class Header_test extends TestCase
{
	public function test_good_coding()
	{
		$output = $this->request('GET', ['Header', 'good_coding']);
		$this->assertEquals('test', $output);
	}

	/**
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function test_bad_coding()
	{
		$output = $this->request('GET', ['Header', 'bad_coding']);
		$this->assertEquals('test', $output);
	}
}
