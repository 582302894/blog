<?php

namespace lib\obj\driver\cache;

class cache extends \Doctrine\Common\Cache\FilesystemCache {

    public function __construct($dir) {
        parent::__construct($dir);
    }

    public function set($name, $value, $time = null) {
        if ($time == null) {
            $time = 3600;
        }
        $this->doSave($name, $value, $time);
    }

    public function get($name) {
        $value = $this->doFetch($name);
        if ($value == false) {
            $this->del($name);
        }
        return $value;
    }

    public function del($name) {
        $value = $this->doDelete($name);
        return $value;
    }

}