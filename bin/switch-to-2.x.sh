#!/bin/sh

mv composer.json composer.json.bk
rm composer.lock
git checkout 2.x
cp composer.json.local composer.json
composer update
git clean -fd public/uploads/
rm -rf application/tests/_ci_phpunit_test/tmp/cache
