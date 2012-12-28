#!/usr/bin/env bash

bldblu=${txtbld}$(tput setaf 4)
txtrst=$(tput sgr0)

if [ "$1" == "--stop-on-failure" ]
then
    CMD='phpunit -c app/ --stop-on-failure'
elif [ "$1" == "--coverage" ]
then
    CMD='phpunit -c app --coverage-html web/coverage'
else
    CMD='phpunit -c app'
fi

./bin/create_database.sh test
rm -rf app/cache/*
rm -rf app/logs/*

${CMD[@]}