<?php

namespace Kenjis\MonkeyPatch\Patcher;

use Kenjis\MonkeyPatch\MonkeyPatch;
use Kenjis\MonkeyPatch\Patcher\FunctionPatcher\Proxy;

/**
 * @group ci-phpunit-test
 * @group patcher
 */
class FunctionPatcher_test extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider provide_source
	 */
	public function test_patch($source, $expected)
	{
		list($actual,) = FunctionPatcher::patch($source);
		$this->assertEquals($expected, $actual);
	}

	public function provide_source()
	{
		return [
[<<<'EOL'
<?php
mt_rand(1, 100);
EOL
,
<<<'EOL'
<?php
\__FuncProxy__::mt_rand(1, 100);
EOL
],

[<<<'EOL'
<?php
exit();
EOL
,
<<<'EOL'
<?php
exit();
EOL
],

[<<<'EOL'
<?php
namespace Foo;
mt_rand(1, 100);
EOL
,
<<<'EOL'
<?php
namespace Foo;
\__FuncProxy__::mt_rand(1, 100);
EOL
],

[<<<'EOL'
<?php
namespace Foo;
Bar\mt_rand(1, 100);
EOL
,
<<<'EOL'
<?php
namespace Foo;
Bar\mt_rand(1, 100);
EOL
],
		];
	}

	/**
	 * @dataProvider provide_source_blacklist
	 */
	public function test_addBlacklist($source, $expected)
	{
		\CIPHPUnitTestReflection::setPrivateProperty(
			'Kenjis\MonkeyPatch\Patcher\FunctionPatcher',
			'lock_function_list',
			false
		);

		FunctionPatcher::addBlacklist('mt_rand');

		list($actual,) = FunctionPatcher::patch($source);
		$this->assertEquals($expected, $actual);

		FunctionPatcher::removeBlacklist('mt_rand');

		\CIPHPUnitTestReflection::setPrivateProperty(
			'Kenjis\MonkeyPatch\Patcher\FunctionPatcher',
			'lock_function_list',
			true
		);
	}

	public function provide_source_blacklist()
	{
		return [
[<<<'EOL'
<?php
mt_rand(1, 100);
time();
EOL
,
<<<'EOL'
<?php
mt_rand(1, 100);
\__FuncProxy__::time();
EOL
],
		];
	}

	/**
	 * @dataProvider provide_source_not_loaded
	 */
	public function test_not_loaded_function($source, $expected)
	{
		list($actual,) = FunctionPatcher::patch($source);
		$this->assertEquals($expected, $actual);
	}

	public function provide_source_not_loaded()
	{
		return [
[<<<'EOL'
<?php
not_loaded_func();
date(DATE_ATOM);
EOL
,
<<<'EOL'
<?php
not_loaded_func();
\__FuncProxy__::date(DATE_ATOM);
EOL
],
		];
	}

	/**
	 * @expectedException        LogicException
	 * @expectedExceptionMessage Can't patch on 'redirect'. It is in blacklist.
	 */
	public function test_patch_on_blacklisted_func()
	{
		MonkeyPatch::patchFunction('redirect', null);
	}

	/**
	 * @expectedException        LogicException
	 * @expectedExceptionMessage Can't patch on 'htmlspecialchars'. It is not in whitelist.
	 */
	public function test_patch_on_not_whitelisted_func()
	{
		MonkeyPatch::patchFunction('htmlspecialchars', null);
	}

	/**
	 * @expectedException        LogicException
	 * @expectedExceptionMessage Can't patch on function 'ksort'.
	 */
	public function test_Proxy_checkPassedByReference()
	{
		Proxy::ksort([]);
	}
}
