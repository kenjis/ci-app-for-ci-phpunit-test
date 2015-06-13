#!/bin/sh

git checkout -- application/tests/TestCase.php

cd application/tests
phpunit -v --debug
