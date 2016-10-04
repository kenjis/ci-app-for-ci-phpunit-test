<?php

class Super_global_test extends TestCase
{
	public function test_index_with_get_params()
	{
		$output = $this->request(
			'GET',
			'super_global',
			[
				'name' => 'Mike O\'Reilly',
				'nickname' => '~mike',
				'city' => '東京',
			]
		);

		$expected = <<< 'EOL'
$_GET: array (
  'name' => 'Mike O\'Reilly',
  'nickname' => '~mike',
  'city' => '東京',
)
EOL;
		$this->assertContains($expected, $output);

		$expected = <<< 'EOL'
'REQUEST_URI' => '/super_global?name=Mike+O%27Reilly&nickname=%7Emike&city=%E6%9D%B1%E4%BA%AC',
EOL;
		$this->assertContains($expected, $output);
	}

	public function test_index_with_query_string()
	{
		$output = $this->request(
			'GET',
			'/super_global?name=Mike+O%27Reilly&nickname=~mike&city=%E6%9D%B1%E4%BA%AC'
		);

		$expected = <<< 'EOL'
$_GET: array (
  'name' => 'Mike O\'Reilly',
  'nickname' => '~mike',
  'city' => '東京',
)
EOL;
		$this->assertContains($expected, $output);

		$expected = <<< 'EOL'
'REQUEST_URI' => '/super_global?name=Mike+O%27Reilly&nickname=%7Emike&city=%E6%9D%B1%E4%BA%AC',
EOL;
		$this->assertContains($expected, $output);
	}

	public function test_index_with_2nd_arg_array()
	{
		$output = $this->request(
			'GET',
			['super_global', 'index', '6146', 'new-song'],
			[
				'name' => 'Mike O\'Reilly',
				'nickname' => '~mike',
				'city' => '東京',
			]
		);

		$expected = <<< 'EOL'
$_GET: array (
  'name' => 'Mike O\'Reilly',
  'nickname' => '~mike',
  'city' => '東京',
)
EOL;
		$this->assertContains($expected, $output);

		$expected = <<< 'EOL'
'REQUEST_URI' => '/super_global/index/6146/new-song?name=Mike+O%27Reilly&nickname=%7Emike&city=%E6%9D%B1%E4%BA%AC',
EOL;
		$this->assertContains($expected, $output);
	}

	public function test_index_path_info()
    {
        $output = $this->request(
            'GET',
            'super_global/index'
        );
        $expected = <<< 'EOL'
'PATH_INFO' => '/super_global/index',
EOL;
        $this->assertContains($expected, $output);
    }
}
