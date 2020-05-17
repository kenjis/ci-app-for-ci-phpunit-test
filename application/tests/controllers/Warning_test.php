<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Warning_test extends TestCase
{
	public function test_index()
	{
		// This test is for checking if ci-phpunit-test throws RuntimeException
		// when there is a warning in a request output.
		// In the real world, you just should fix your code that causes warning.

		try {
			// The controller raise a warning, and ci-phpunit-test turns it into RuntimeException
			$output = $this->request('GET', 'warning/index');
			$this->assertStringContainsString('Warning::index', $output);
		}
		catch (RuntimeException $e)
		{
			if ($this->is_phpunit_91_and_greater()) {
				$this->assertMatchesRegularExpression('/Undefined variable: undefined_variable/', $e->getMessage());
			}
			else
			{
				$this->assertRegExp('/Undefined variable: undefined_variable/', $e->getMessage());
			}

			while (ob_get_level() > 1)
			{
				ob_end_clean();
			}
		}
	}

	private function is_phpunit_91_and_greater()
	{
		if (class_exists('PHPUnit\Runner\Version')) {
			if (version_compare(\PHPUnit\Runner\Version::series(), '9.1') >= 0) {
				return true;
			}
		}

		return false;
	}
}
