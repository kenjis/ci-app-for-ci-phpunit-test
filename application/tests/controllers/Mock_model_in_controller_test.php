<?php

class Mock_model_in_controller_test extends TestCase
{
	public function test_index()
	{
		$this->request->setCallable(
			function ($CI) {
				$return = [
					0 => (object) ['id' => '1', 'name' => 'ABC'],
					1 => (object) ['id' => '2', 'name' => 'DEF'],
					2 => (object) ['id' => '3', 'name' => 'GHI'],
				];
				
				// Without this line, we get "RuntimeException: The model name you are loading is the name of a resource that is already being used: Category_model"
				$CI->load->model('Category_model');
				
				$model = $this->getDouble(
					'Category_model',
					['get_category_list' => $return]
				);
				$CI->Category_model = $model;
			}
		);

		$output = $this->request('GET', 'mock_model_in_controller');
		$this->assertContains("ABC\nDEF\nGHI", $output);
	}
}
