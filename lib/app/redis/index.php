<?php
namespace lib\app\redis;
use lib\obj\PhpRedis;

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
            echo "redis连接成功\n";
        } else {
            throw new \Exception("redis连接失败");
        }
        PhpRedis::connect();
        // sleep(2);
        $connect = PhpRedis::connect();
        if ($connect === false) {
            throw new \Exception("Predis连接失败");
        }
        $connect->transaction(function ($tx) {
            $tx->set('test', 'a');
            $tx->set('test1', 'b');
        });
        echo $connect->get('test') . "\n";
        echo $connect->get('test1') . "\n";
    }
}