<?php

namespace Kenjis\MonkeyPatch\Patcher;

use TestCase;

/**
 * @group ci-phpunit-test
 * @group patcher
 */
class ExitPatcher_test extends TestCase
{
	/**
	 * @dataProvider provide_source
	 */
	public function test_die($source, $expected)
	{
		list($actual,) = ExitPatcher::patch($source);
		$this->assertEquals($expected, $actual);
	}

	public function provide_source()
	{
		return [
[<<<'EOL'
<?php
die();
EOL
,
<<<'EOL'
<?php
exit__();
EOL
],
[<<<'EOL'
<?php
die;
EOL
,
<<<'EOL'
<?php
exit__();
EOL
],
[<<<'EOL'
<?php
exit();
EOL
,
<<<'EOL'
<?php
exit__();
EOL
],
[<<<'EOL'
<?php
exit;
EOL
,
<<<'EOL'
<?php
exit__();
EOL
],
[<<<'EOL'
<?php
exit('status');
EOL
,
<<<'EOL'
<?php
exit__('status');
EOL
],
		];
	}
}
