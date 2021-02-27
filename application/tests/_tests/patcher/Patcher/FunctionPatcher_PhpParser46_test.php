<?php

namespace Kenjis\MonkeyPatch\Patcher;

use Kenjis\MonkeyPatch\MonkeyPatch;
use Kenjis\MonkeyPatch\Patcher\FunctionPatcher\Proxy;
use LogicException;
use ReflectionHelper;

require_once __DIR__ . '/PhpParserTestCase.php';

/**
 * @group ci-phpunit-test
 * @group patcher
 */
class FunctionPatcher_PhpParser46_test extends PhpParserTestCase
{
	/**
	 * @var FunctionPatcher
	 */
	private $obj;

	public function setUp(): void
	{
		parent::setUp();

		$this->obj = new FunctionPatcher();
	}

	/**
	 * @dataProvider provide_source
	 */
	public function test_patch($source, $expected)
	{
		if (! $this->phpParserVersion->isGreaterThanOrEqualTo('4.6')) {
			$this->markTestSkipped();
		}

		list($actual,) = $this->obj->patch($source);
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

exit;
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
		if (! $this->phpParserVersion->isGreaterThanOrEqualTo('4.6')) {
			$this->markTestSkipped();
		}

		ReflectionHelper::setPrivateProperty(
			'Kenjis\MonkeyPatch\Patcher\FunctionPatcher',
			'lock_function_list',
			false
		);

		FunctionPatcher::addBlacklist('mt_rand');

		list($actual,) = $this->obj->patch($source);
		$this->assertEquals($expected, $actual);

		FunctionPatcher::removeBlacklist('mt_rand');

		ReflectionHelper::setPrivateProperty(
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
		if (! $this->phpParserVersion->isGreaterThanOrEqualTo('4.6')) {
			$this->markTestSkipped();
		}

		list($actual,) = $this->obj->patch($source);
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

	public function test_patch_on_blacklisted_func()
	{
		ob_start();
		try {
			MonkeyPatch::patchFunction('redirect', null);
		} catch (LogicException $e) {
			$this->assertContains(
				"Can't patch on 'redirect'. It is in blacklist.",
				$e->getMessage()
			);
		}
		ob_end_clean();
	}

	public function test_patch_on_not_whitelisted_func()
	{
		ob_start();
		try {
			MonkeyPatch::patchFunction('htmlspecialchars', null);
		} catch (LogicException $e) {
			$this->assertContains(
				"Can't patch on 'htmlspecialchars'. It is not in whitelist.",
				$e->getMessage()
			);
		}
		ob_end_clean();
	}

	public function test_Proxy_checkPassedByReference()
	{
		ob_start();
		try {
			Proxy::ksort([]);
		} catch (LogicException $e) {
			$this->assertContains(
				"Can't patch on function 'ksort'.",
				$e->getMessage()
			);
		}
		ob_end_clean();
	}

	/**
	 * @expectedException        LogicException
	 * @expectedExceptionMessage You can't add to whitelist after initialization
	 */
	public function test_addWhitelists()
	{
		FunctionPatcher::addWhitelists(['mt_rand']);
	}
}
