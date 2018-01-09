<?php

namespace lib\app\test;

use Workerman\Worker;

class workerman {
    public function index() {
        runWorker();
    }

    public function test() {
        return view('');
    }
}

function runWorker() {

    // Create a Websocket server
    $ws_worker = new Worker("websocket://127.0.0.1:2000");

    // 4 processes
    $ws_worker->count = 4;

    $ws_worker->cons = [];

    // Emitted when new connection come
    $ws_worker->onConnect = function ($connection) {
        for ($i = 1; $i < 100000; $i++) {
            if (!isset($ws_worker->cons[$i])) {
                $ws_worker->cons[$i] = $i;
                $connection->id = $i;
                break;
            }
        }
    };

    // Emitted when data received
    $ws_worker->onMessage = function ($connection, $data) {
        // Send hello $data
        $connection->send('hello ' . $data . ':' . $connection->id);
    };

    // Emitted when connection closed
    $ws_worker->onClose = function ($connection) {
        $i = $connection->id;
        echo $i . "\n\t";
    };

    // Run worker
    Worker::runAll();
}