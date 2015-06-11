<?php

class Query_string_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', ['Query_string', 'index'], ['name' => 'Mike']);
		$this->assertEquals('Mike, you sent Query string!', $output);
	}

	public function test_uri_index()
	{
		$output = $this->request('GET', 'query_string/index', ['name' => 'Mike']);
		$this->assertEquals('Mike, you sent Query string!', $output);
	}
}
