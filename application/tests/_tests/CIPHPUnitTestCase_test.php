<?php

/**
 * @group ci-phpunit-test
 */
class CIPHPUnitTestCase_test extends UnitTestCase
{
	public function test_when_create_model_then_you_can_get_the_model()
	{
		$model = $this->newModel('Greeter');
		$this->assertInstanceOf('Greeter', $model);
	}

	public function test_when_create_model_in_subdir_then_you_can_get_the_model()
	{
		$model = $this->newModel('subdir/Subdir_model');
		$this->assertInstanceOf('Subdir_model', $model);
	}

	public function test_when_create_library_then_you_can_get_the_libary()
	{
		$libary = $this->newLibrary('Foo');
		$this->assertInstanceOf('Foo', $libary);
	}

	public function test_when_create_library_in_subdir_then_you_can_get_the_libary()
	{
		$libary = $this->newLibrary('subdir/Subdir_library');
		$this->assertInstanceOf('Subdir_library', $libary);
	}
}
