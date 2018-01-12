<?php

namespace lib\app\test;

class workerman {
    public function runWorkerTest1() {
        require_once COMPOSER_SCRIPT_PATH . '/lib/app/test/server/workermanTest1.php';
        runWorkerTest1();
    }

    public function runWorkerTest2() {
        return view();
    }

    public function talk() {
        try {
            throw new \Exception("Error Processing Request", 1);            
        } catch (\Exception $e) {
            // Log
        }
        return view();
    }

    public function runWorkerTest3() {
        $runWorkerTest3 = server('runWorkerTest3', 'test')->runWorker();
    }
}