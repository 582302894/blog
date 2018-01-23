<?php

namespace lib\app\test;
use lib\obj\cache;
use lib\obj\log;

class test {
    public function find() {
        $find = server('find');
        $files = $find->getFiles();
        // return view();
    }

    public function test() {
        // log::error('nameasdlasjdlasd');
        try {
            throw new \Exception("Error Processing Request", 1);
        } catch (\Exception $e) {
            log::exception($e);
        }
        die;
        Cache::get('name');
    }
}