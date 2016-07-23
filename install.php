#!/usr/bin/env php
<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

$installer = new Installer();
$installer->prepareForWindows();

system('php vendor/kenjis/ci-phpunit-test/install.php');

$installer->install();

class Installer
{
    public static function prepareForWindows()
    {
        if (! self::isWindows()) {
            return;
        }

        // Remove symlink
        unlink('application/tests/_ci_phpunit_test');
    }

    private static function isWindows(){
        return defined('PHP_WINDOWS_VERSION_MAJOR');
    }

    public static function install()
    {
        self::recursiveCopy(
            'vendor/kenjis/ci-phpunit-test/application/database',
            'application/database'
        );
        self::recursiveCopy(
            'vendor/kenjis/ci-phpunit-test/application/libraries',
            'application/libraries'
        );

        self::copy(
            'application/tests/phpunit.xml.dist',
            'application/tests/phpunit.xml'
        );
        self::copy(
            'application/tests/TestCase.php.dist',
            'application/tests/TestCase.php'
        );
        self::copy(
            'application/tests/Bootstrap.php.dist',
            'application/tests/Bootstrap.php'
        );
    }

    private static function copy($src, $dst)
    {
        $success = copy($src, $dst);
        if ($success) {
            echo 'copied: ' . $dst . PHP_EOL;
        }
    }

    /**
     * Recursive Copy
     *
     * @param string $src
     * @param string $dst
     */
    private static function recursiveCopy($src, $dst)
    {
        if (! is_dir($src)) {
            echo 'No such directory: ' . $src . PHP_EOL;
            return;
        }

        @mkdir($dst, 0755);
        
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($src, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                @mkdir($dst . '/' . $iterator->getSubPathName());
            } else {
                $success = copy($file, $dst . '/' . $iterator->getSubPathName());
                if ($success) {
                    echo 'copied: ' . $dst . '/' . $iterator->getSubPathName() . PHP_EOL;
                }
            }
        }
    }
}
