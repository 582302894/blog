<?php
namespace lib\app\test\server;

use think\Db;
use Workerman\Worker;

class runWorkerTest3 {
    public function runWorker() {
        runWorkerTest3();

    }

}

function runWorkerTest3() {

    // Create a Websocket server
    $ws_worker = new Worker("websocket://127.0.0.1:2000");

    // 4 processes
    $ws_worker->count = 4;

    $ws_worker->cons = [];

    $ws_worker->onConnect = function ($connection) {
    };

    $ws_worker->onMessage = function ($connection, $message) {
        try {
            dealMessageCatch($connection, $message);
        } catch (\Exception $e) {
            //异常处理
            // throw $e;
        }

    };

    $ws_worker->onClose = function ($connection) {
        try {
            dealClose($connection);
        } catch (\Exception $e) {
            //异常处理
            // throw $e;
        }
    };

    Worker::runAll();
}

/**
 * 接收消息处理
 * @return [type] [description]
 */
function dealMessage(&$con, $message) {
    $message = json_decode($message, true);
    if ($message['action'] == 'init') {
        addNewUser($con, $message['username']);
    }
}
/**
 * 添加一个新用户
 * @return [type] [description]
 */
function addNewUser(&$con, $username) {
    $user = Db::table('user')->where('username', $username)->find();
    if ($user != null && $user['online_status'] == 1) {
        $con->send(json_encode([
            'action' => 'error',
            'message' => '该名字已经存在了',
        ]));
        return;
    }
    if ($user != null) {
        $user['username'] = date('Y-m-d H:i:s') . '-' . $con->id;
        Db::table('user')->update($user);
    }
    $conUser = Db::table('user')->where('con_id', $con->id)->find();
    if ($conUser == null) {
        Db::table('user')->insert([
            'username' => $username,
            'con_id' => $con->id,
            'create_time' => date('Y-m-d H:i:s'),
            'online_time' => date('Y-m-d H:i:s'),
            'online_status' => 1,
        ]);
    }
    if ($conUser != null) {
        $conUser['online_status'] = 1;
        $conUser['online_time'] = date('Y-m-d H:i:s');
        $conUser['username'] = $username;
        Db::table('user')->update($conUser);
    }

    $userLists = getUserLists($con);
    sendMessageToAll($con, json_encode(['action' => 'userLists', 'userLists' => $userLists]));
    sendMessageToAll($con, json_encode(['action' => 'all', 'message' => $username . ' 上线了', 'client_id' => $con->id]));
}

function getUserLists(&$con) {
    $conIds = [-1];
    foreach ($con->worker->connections as $connection) {
        $conIds[] = $connection->id;
    }
    $userLists = Db::table('user')->where('con_id', 'in', $conIds)->where('online_status', 1)->select();
    return (Array) $userLists;
}

function sendMessageToAll(&$con, $json) {
    foreach ($con->worker->connections as $connection) {
        $connection->send($json);
    }
}

/**
 * 下线处理
 * @param  [type] $ws_worker  [description]
 * @param  [type] $connection [description]
 * @return [type]             [description]
 */
function dealClose($con) {
    $user = Db::table('user')->where('con_id', $con->id)->find();
    if ($user == null) {
        return;
    }
    $user['close_time'] = date('Y-m-d H:i:s');
    $user['online_status'] = 0;
    Db::table('user')->update($user);
    sendMessageToAll($con, json_encode(['action' => 'all', 'message' => $user['username'] . ' 下线了', 'client_id' => $con->id]));
}