<?php

namespace Kenjis\MonkeyPatch\Patcher;

require_once __DIR__ . '/PhpParserTestCase.php';

/**
 * @group ci-phpunit-test
 * @group patcher
 */
class ConstantPatcher_PhpParser46_test extends PhpParserTestCase
{
	/**
	 * @var ConstantPatcher
	 */
	private $obj;

	public function setUp(): void
	{
		parent::setUp();

		$this->obj = new ConstantPatcher();
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

	/**
	 * @dataProvider provide_source_cannot_patch
	 */
	public function test_cannot_patch($source, $expected)
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
