<?php

$data = [
    'ENV_DEBUG' => false,
    'cache_path' => COMPOSER_SCRIPT_PATH . '/lib/runtime/cache/data',
    'runtime_workerman' => COMPOSER_SCRIPT_PATH . '/lib/runtime/workerman',
    'cache_time' => 3600,
    'mysql' => [
        'host' => '127.0.0.1',
        'dbname' => 'blog_test',
        'user' => 'blog',
        'password' => 'blog',
        'port' => '3306',
        'charset' => 'utf-8',
    ],
    'smarty' => [
        'left' => '{----',
        'right' => '----}',
    ],
    'redis' => [
        'host' => '127.0.0.1',
        'port' => '6379',
    ],
];

if (file_exists(__DIR__ . '/private.php')) {
    $private = require __DIR__ . '/private.php';
    $data = array_merge($data, $private);
}

return $data;