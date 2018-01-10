<?php

namespace lib\app\test;


class workerman {
    public function runWorkerTest1() {
        require_once COMPOSER_SCRIPT_PATH . '/lib/app/test/server/workermanTest1.php';
        runWorkerTest1();
    }

    public function test() {
        return view('');
    }

    public function talk() {
        show(db('user')->select());
    }
}