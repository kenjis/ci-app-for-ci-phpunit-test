<?php

namespace Kenjis\MonkeyPatch\Patcher;

use Kenjis\MonkeyPatch\PhpParserVersion;
use TestCase;

abstract class PhpParserTestCase extends TestCase
{
	/**
	 * @var PhpParserVersion
	 */
	protected $phpParserVersion;

	public function setUp()
	{
		$this->phpParserVersion = new PhpParserVersion();
	}
}
