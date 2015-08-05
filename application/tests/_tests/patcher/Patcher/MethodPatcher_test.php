<?php

namespace Kenjis\MonkeyPatch\Patcher;

/**
 * @group ci-phpunit-test
 * @group patcher
 */
class MethodPatcher_test extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider provide_source
	 */
	public function test_patch($source, $expected)
	{
		list($actual,) = MethodPatcher::patch($source);
		$this->assertEquals($expected, $actual);
	}

	public function provide_source()
	{
		return [
[<<<'EOL'
<?php
class Foo
{
	public function bar()
	{
		echo 'Bar';
	}
}
EOL
,
<<<'EOL'
<?php
class Foo
{
	public function bar()
	{ if (($__ret__ = \__PatchManager__::getReturn(__CLASS__, __FUNCTION__, func_get_args())) !== __GO_TO_ORIG__) return $__ret__;
		echo 'Bar';
	}
}
EOL
],

[<<<'EOL'
<?php
class Foo
{
	public function bar() {
		echo 'Bar';
	}
}
EOL
,
<<<'EOL'
<?php
class Foo
{
	public function bar() { if (($__ret__ = \__PatchManager__::getReturn(__CLASS__, __FUNCTION__, func_get_args())) !== __GO_TO_ORIG__) return $__ret__;
		echo 'Bar';
	}
}
EOL
],

[<<<'EOL'
<?php
class Foo
{
	public static function bar() {
		echo 'Bar';
	}
}
EOL
,
<<<'EOL'
<?php
class Foo
{
	public static function bar() { if (($__ret__ = \__PatchManager__::getReturn(__CLASS__, __FUNCTION__, func_get_args())) !== __GO_TO_ORIG__) return $__ret__;
		echo 'Bar';
	}
}
EOL
],
		];
	}
}
