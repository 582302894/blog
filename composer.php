<?php
namespace composer;

define('COMPOSER_SCRIPT_PATH', __DIR__);
try {
    require COMPOSER_SCRIPT_PATH . '/lib/autoload.php';
} catch (\Exception $e) {
    var_dump($e);
}