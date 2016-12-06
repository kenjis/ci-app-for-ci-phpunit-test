<?php

/**
 * @group patcher
 */
class Greeter_test extends TestCase
{
	public function setUp()
	{
		$this->obj = $this->newModel('Greeter');
	}

	/**
	 * @dataProvider provide_hours
	 */
	public function test_greet($hour, $msg)
	{
		MonkeyPatch::patchFunction('date', $hour, 'Greeter');

		$actual = $this->obj->greet();
		$this->assertEquals($msg, $actual);
	}

	public function provide_hours()
	{
		return [
			['00', 'Good evening'],
			['04', 'Good evening'],
			['05', 'Good morning'],
			['11', 'Good morning'],
			['12', 'Good afternoon'],
			['17', 'Good afternoon'],
			['18', 'Good evening'],
			['23', 'Good evening'],
		];
	}
}
