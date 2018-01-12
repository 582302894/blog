<?php

if (!function_exists('view')) {
    function view($path = '', $args = []) {
        return \lib\obj\view::show($path, $args);
    }
}

if (!function_exists('server')) {
    function server($name, $model) {
        if ($model == null) {
            $model = APP_MODEL;
        }
        $class = '\lib\app\\' . $model . '\server\\' . $name;
        require_once COMPOSER_SCRIPT_PATH . $class . '.php';
        return new $class();
    }
}