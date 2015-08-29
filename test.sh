#!/bin/sh

cd `dirname $0`

cd application/tests
../../vendor/bin/phpunit -v --debug $@

#find . -name '*_test.php' -exec ../../vendor/bin/phpunit -v --debug {} \;
