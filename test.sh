#!/bin/sh

cd application/tests
phpunit -v --debug $@
