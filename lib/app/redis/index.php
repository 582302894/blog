<?php
namespace lib\app\redis;

class index {
    public function index() {
        $host = Config('redis', 'host');
        $port = Config('redis', 'port');
        if (!class_exists('Redis')) {
            throw new \Exception("没有redis扩展类");
        }
        $redis = new \Redis();
        $flag = $redis->connect($host, $port);
        if ($flag) {
            throw new \Exception("redis链接成功");
        } else {
            throw new \Exception("redis链接失败");
        }
    }
}