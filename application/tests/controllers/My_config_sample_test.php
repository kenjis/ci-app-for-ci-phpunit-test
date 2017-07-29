
<?php

class My_config_sample_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'my_config_sample');
		$this->assertEquals('http://this.is.my.config/', $output);
	}
}
