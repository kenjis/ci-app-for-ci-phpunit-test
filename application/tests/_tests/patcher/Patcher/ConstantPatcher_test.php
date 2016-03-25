<?php

namespace Kenjis\MonkeyPatch\Patcher;

/**
 * @group ci-phpunit-test
 * @group patcher
 */
class ConstantPatcher_test extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->obj = new ConstantPatcher();
	}

	/**
	 * @dataProvider provide_source
	 */
	public function test_patch($source, $expected)
	{
		list($actual,) = $this->obj->patch($source);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider provide_source_cannot_patch
	 */
	public function test_cannot_patch($source, $expected)
	{
		list($actual,) = $this->obj->patch($source);
		$this->assertEquals($expected, $actual);
	}

	public function provide_source()
	{
		return [
[<<<'EOL'
<?php
echo ENVIRONMENT;
EOL
,
<<<'EOL'
<?php
echo \__ConstProxy__::get('ENVIRONMENT');
EOL
],
		];
	}

	public function provide_source_cannot_patch()
	{
		return [
[<<<'EOL'
<?php
function test($a = ENVIRONMENT)
{
}
EOL
,
<<<'EOL'
<?php
function test($a = ENVIRONMENT)
{
}
EOL
],
		];
	}
}
