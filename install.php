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

system('php vendor/kenjis/ci-phpunit-test/install.php');

$installer = new Installer();
$installer->install();

class Installer
{
    public static function install()
    {
        self::recursiveCopy(
            'vendor/kenjis/ci-phpunit-test/application/database',
            'application/database'
        );
        self::recursiveCopy(
            'vendor/kenjis/ci-phpunit-test/application/helpers',
            'application/helpers'
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
