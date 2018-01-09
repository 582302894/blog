<?php

class FileCache extends \Doctrine\Common\Cache\PhpFileCache {
    private static $_instance = null;
    protected $path = COMPOSER_SCRIPT_PATH . '/static/cache';
    public function __construct() {
        if (!is_dir($this->path)) {
            mkdir($this->path, 0777, true);
        }
        parent::__construct($this->path);
    }

    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function set($key, $name, $time = null) {
        $self = self::getInstance();
        if ($time == null) {
            $time = CACHE_TIME;
        }
        $self->doSave($key, $name, $time);
    }

    public function get($key) {
        $self = self::getInstance();
        $value = $self->doFetch($key);
        return $value;
    }

    public function del() {
        $self = self::getInstance();
        $value = $self->doFetch($key);
        return $value;
    }
}