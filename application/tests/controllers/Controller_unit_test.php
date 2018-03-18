<?php

class Controller_unit_test extends UnitTestCase
{
	public function test_ajax_index()
	{
		$this->expectOutputString('Not Ajax request');

		$controller = $this->newController('Ajax');
		$controller->index();
	}
}
