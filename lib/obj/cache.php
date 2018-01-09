<?php

namespace lib\obj;

class cache {

    public static $_instance = null;

    public function __construct() {
        throw new \Exception("Class cache forbidden");
    }

    public static function connect() {
        $cachePath = Config('cache_path');
        require_once COMPOSER_SCRIPT_PATH . '/lib/obj/driver/cache/cache.php';
        $class = '\\lib\\obj\\driver\\cache\\cache';
        return new $class($cachePath);
    }

    public static function init() {
        if (self::$_instance == null) {
            self::$_instance = self::connect();
        }
        self::$_instance = self::connect();
        return self::$_instance;
    }

    public static function get($name) {
        if ($name == '') {
            throw new \Exception("cache::get arguments not null");
        }
        return self::init()->get($name);
    }

    public static function set($name, $value, $leftTime = 0) {
        if ($name == '') {
            throw new \Exception("cache::get arguments not null");
        }
        if ($leftTime == 0) {
            $leftTime = Config('cache_time');
        }
        return self::init()->set($name, $value, $leftTime);
    }

    public static function del($name) {
        if ($name == '') {
            throw new \Exception("cache::get arguments not null");
        }
        return self::init()->del($name);
    }
}