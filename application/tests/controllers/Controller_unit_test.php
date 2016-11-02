<?php

class Controller_unit_test extends TestCase
{
	public function test_ajax_index()
	{
		$this->expectOutputString('Not Ajax request');

		$controller = $this->newController('Ajax');
		$controller->index();
	}
}
