<?php

namespace lib\obj;
use think\Db as thinkDb;

class Db {

    static $config;

    /**
     * 初始化数据库链接信息
     * @param  array  $config [description]
     * @return [type]         [description]
     */
    public static function run($config = []) {

        $dbConfig = [
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
        ];

        if (!empty($config)) {
            self::$config = array_merge($dbConfig, $config);
        } else {
            self::$config = $dbConfig;
        }

        thinkDb::setConfig(self::$config);
    }
}