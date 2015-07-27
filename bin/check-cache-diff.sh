#!/bin/sh

cd `dirname $0`

cd ../application/tests/tmp/cache

list=`find . -type f`

cd ../../../..

for i in $list
do
	#echo "$i" "./application/tests/tmp/cache/$i"
	diff -u "$i" "./application/tests/tmp/cache/$i"
done
