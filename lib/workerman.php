<?php

require __DIR__ . '/../composer.php';
require COMPOSER_SCRIPT_PATH . '/lib/app/test/workerman.php';
$class = 'lib\\app\\test\\workerman';

$workerman = new $class();
$workerman->runWorkerTest1();