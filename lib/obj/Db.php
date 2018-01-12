<?php

namespace lib\obj;
use think\Db as thinkDb;

class Db {
    public static function run() {
        thinkDb::setConfig([
            // 数据库类型
            'type' => 'mysql',
            // 服务器地址
            'hostname' => config('mysql')['host'],
            // 数据库名
            'database' => config('mysql')['dbname'],
            // 用户名
            'username' => config('mysql')['user'],
            // 密码
            'password' => config('mysql')['password'],
            // 端口
            'hostport' => config('mysql')['port'],
        ]);
    }
}