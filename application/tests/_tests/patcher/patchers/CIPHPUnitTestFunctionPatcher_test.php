<?php

/**
 * @group patcher
 */
class CIPHPUnitTestFunctionPatcher_test extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider provide_source
	 */
	public function test_patch($source, $expected)
	{
		list($actual,) = CIPHPUnitTestFunctionPatcher::patch($source);
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

\CIPHPUnitTestFunctionPatcherProxy::mt_rand(1, 100);
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

\CIPHPUnitTestFunctionPatcherProxy::mt_rand(1, 100);
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
		CIPHPUnitTestFunctionPatcherNodeVisitor::addBlacklist('mt_rand');

		list($actual,) = CIPHPUnitTestFunctionPatcher::patch($source);
		$this->assertEquals($expected, $actual);
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
\CIPHPUnitTestFunctionPatcherProxy::time();
EOL
],
		];
	}

	/**
	 * @dataProvider provide_source_not_loaded
	 */
	public function test_not_loaded_function($source, $expected)
	{
		list($actual,) = CIPHPUnitTestFunctionPatcher::patch($source);
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
\CIPHPUnitTestFunctionPatcherProxy::date(DATE_ATOM);
EOL
],
		];
	}
}
