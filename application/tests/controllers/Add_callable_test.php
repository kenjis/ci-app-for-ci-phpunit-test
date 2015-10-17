<?php

class Add_callable_test extends TestCase
{
	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();
		
		$CI =& get_instance();
		$CI->load->library('Seeder');
		$CI->seeder->call('CategorySeeder');
	}

	public function setUp()
	{
		$this->request->setCallable(
			function ($CI) {
				$CI->load->model('greeter');
				
				$model = $this->getDouble(
					'Greeter',
					['greet' => 'Greeting from Mocked Greeter']
				);
				$CI->greeter = $model;
			}
		);
	}

	public function test_index_mock_foo()
	{
		$this->request->addCallable(
			function ($CI) {
				$CI->load->library('foo');
				
				$library = $this->getDouble(
					'Foo',
					['doSomething' => 'Return from Mocked Foo']
				);
				$CI->foo = $library;
			}
		);

		$output = $this->request('GET', 'add_callable');
		$this->assertContains(
			'Greeting from Mocked Greeter3Return from Mocked Foo', $output
		);
	}

	public function test_index_mock_category_model()
	{
		$this->request->addCallable(
			function ($CI) {
				$CI->load->model('category_model');
				
				$model = $this->getDouble(
					'Category_model',
					['get_category_list' => range(1, 5)]
				);
				$CI->category_model = $model;
			}
		);

		$output = $this->request('GET', 'add_callable');
		$this->assertContains(
			'Greeting from Mocked Greeter5something', $output
		);
	}
}
