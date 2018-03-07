<?php
namespace composer;

define('PHP_CLI', true);
define('COMPOSER_SCRIPT_PATH', __DIR__);

require COMPOSER_SCRIPT_PATH . '/lib/autoload.php';

\my\test::test();