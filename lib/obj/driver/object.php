<?php

namespace lib\obj\driver;

class object {

    protected static $_instance = null;

    public function __construct() {

    }

    public static function init() {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}