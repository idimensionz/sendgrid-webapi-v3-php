#!/usr/bin/env sh

# See http://adamwathan.me/2014/12/28/test-coverage-code-climate-travis-ci
php vendor/bin/test-reporter --stdout > codeclimate.json
curl -X POST -d @codeclimate.json -H 'Content-Type: application/json' -H 'User-Agent: Code Climate (PHP Test Reporter v0.1.1)' https://codeclimate.com/test_reports