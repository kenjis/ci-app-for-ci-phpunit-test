<?php

class Set_header_test extends TestCase
{
	public function test_get_header_value()
	{
    $header_value = 'header_value';
    $this->request->setHeader('X-Request-Header', $header_value);
		$output = $this->request('GET', 'set_header/get_request_header');
    $this->assertEquals($header_value, $output);
	}
  
  public function test_get_header_value_twice()
  {
    $header_value = 'header_value_2';
    $this->request->setHeader('X-Request-Header', $header_value);
    $output = $this->request('GET', 'set_header/get_request_header');
    $this->assertEquals($header_value, $output);
  }
}