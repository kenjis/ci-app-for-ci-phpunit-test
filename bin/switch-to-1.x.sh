#!/bin/sh

mv composer.json composer.json.bk
rm composer.lock
git checkout master
cp composer.json.local composer.json
composer update
git clean -fd public/uploads/
