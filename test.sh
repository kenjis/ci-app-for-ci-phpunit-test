#!/bin/sh

cd `dirname $0`

cd application/tests
../../vendor/bin/phpunit -v --debug $@
