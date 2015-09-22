<?php
// Needed for isolated tests
/** @var $loader \Composer\Autoload\ClassLoader */
$loader = require dirname(__DIR__) . '/vendor/autoload.php';
$loader->add('Tests\\iDimensionz\\SendGridWebApiV3\\', __DIR__.'/tests');
