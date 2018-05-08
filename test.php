<?php

define('COMPOSER_SCRIPT_PATH', __DIR__);

require COMPOSER_SCRIPT_PATH . '/vendor/autoload.php';

\my\test::test();
new \lib\obj\test();