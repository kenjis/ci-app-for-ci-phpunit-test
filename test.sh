#!/bin/sh

XDEBUG=1	# 1 or 0

cd `dirname $0`
DIR=`pwd`

if [ -f "$DIR/vendor/bin/phpunit" ]; then
	PHPUNIT="vendor/bin/phpunit"
else
	PHPUNIT=`which phpunit`
fi

if [ $XDEBUG -eq 1 ]; then
	COMMAND="$PHPUNIT  -v --debug -c application/tests $@"
else
	COMMAND="phpdbg -qrr $PHPUNIT -v --debug -c application/tests $@"
fi

#echo $COMMAND; exit
$COMMAND

#find application/tests/ -name '*_test.php' -exec vendor/bin/phpunit -v --debug -c application/tests {} \;
