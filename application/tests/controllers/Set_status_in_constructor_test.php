<?php

class Set_status_in_constructor_test extends TestCase
{
	public function test_response()
	{
		$output = $this->request('GET', 'Set_status_in_constructor', []);
		$expected = 'OH GAWD!';
		$this->assertEquals($expected, $output);  // works correctly
		$this->assertResponseCode(404, 'not found');  // fails
	}
}
