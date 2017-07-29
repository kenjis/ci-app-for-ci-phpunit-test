<?php

class Post_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('POST', ['Post', 'index'], ['name' => 'Mike']);
		$this->assertEquals('Mike, you sent POST request!', $output);
	}

	public function test_uri_index()
	{
		$output = $this->request('POST', 'post/index', ['name' => 'Mike']);
		$this->assertEquals('Mike, you sent POST request!', $output);
	}

	public function test_post_array()
	{
		$output = $this->request(
			'POST',
			'post/post_array',
			['categories' => ['324']]
		);
		$expected = "array (
  0 => '324',
)";
		$this->assertEquals($expected, $output);
	}
}
