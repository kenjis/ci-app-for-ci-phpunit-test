#!/bin/sh

cd `dirname $0`

cd ../application/tests/_ci_phpunit_test/tmp/cache

list=`find . -type f`

cd ../../../../..

for i in $list
do
	#echo "$i" "./application/tests/_ci_phpunit_test/tmp/cache/$i"
	diff -uwb "$i" "./application/tests/_ci_phpunit_test/tmp/cache/$i"
done
