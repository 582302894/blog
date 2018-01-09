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

    $ws_worker->onConnect = function ($connection) {
        $user = getUser($connection->id);
        $users = getUserList();
        $json = [
            'message' => $user['name'] . ' 上线',
            'users' => $users,
        ];
        foreach ($connection->worker->connections as $con) {
            $con->send(json_encode($json));
        }
    };

    $ws_worker->onMessage = function ($connection, $message) {
        $message = json_decode($message, true);
        $action = $message['action'];
    };

    $ws_worker->onClose = function ($connection) {
        $user = delUser($connection->id);
        $users = getUserList();
        $json = [
            'message' => $user['name'] . ' 下线',
            'users' => $users,
        ];
        foreach ($connection->worker->connections as $con) {
            $con->send(json_encode($json));
        }
    };

    Worker::runAll();
}

/**
 * 获得新用户
 * @return [type] [description]
 */
function getUser($id) {
    $names = ['街桷x襡嗳她', '丶暧昧丨灬媚惑', '小嘴冰灬丿凉', '保存心情', '丨浅色o丶', '寳丶灬尛破孩', '壞丶囡囡', 'www.keaidian.com', '羙兮丶Croty', '卩s丶残雪灬', '結束丶劇情丨'];
    $userFile = config('runtime_workerman') . '/users.txt';
    if (!file_exists($userFile)) {
        $fp = fopen($userFile, 'a');
        fclose($fp);
    }
    $userJson = file_get_contents($userFile);
    $users = json_decode($userJson, true);
    if (count($users) == count($names)) {
        return 'full';
    }
    foreach ($names as $key => $name) {
        $md5 = md5($name);
        if (isset($users[$md5])) {
            continue;
        }
        $user = [
            'md5' => $md5,
            'name' => $name,
            'id' => $id,
        ];
        break;
    }
    $users[$user['md5']] = $user;
    file_put_contents($userFile, json_encode($users));
    return $user;
}
/**
 * 用户下线
 * @param  [type] $md5 [description]
 * @return [type]      [description]
 */
function delUser($id) {
    $userFile = config('runtime_workerman') . '/users.txt';
    $userJson = file_get_contents($userFile);
    $users = json_decode($userJson, true);
    foreach ($users as $key => $user) {
        if ($user['id'] == $id) {
            $temp = $user;
            unset($users[$key]);
        }
    }
    $user = $temp;
    file_put_contents($userFile, json_encode($users));
    return $user;
}
function getUserList() {
    $userFile = config('runtime_workerman') . '/users.txt';
    $userJson = file_get_contents($userFile);
    $users = json_decode($userJson, true);
    return $users;
}