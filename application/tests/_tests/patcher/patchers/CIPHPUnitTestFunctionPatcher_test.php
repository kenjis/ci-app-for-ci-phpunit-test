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
}
