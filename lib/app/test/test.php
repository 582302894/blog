<?php

namespace lib\app\test;
use lib\obj\cache;

class test {
    public function find() {
        $find = server('find');
        $files = $find->getFiles();
        // return view();
    }

    public function test() {
        Cache::get('name');
    }

    public function talk(){
    	
    }
}