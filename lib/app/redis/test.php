<?php
namespace lib\app\redis;
use lib\obj\PhpRedis;

class test {

    public function basic() {
        $redis = new \Redis;
        $redis->connect('127.0.0.1', 6379);
        $redis->close();
        // print_r($redis->get('test')); //Connection closed and exit
        // $redis->pconnect($host,$prot,$seconds);//持久化连接 不会被close关闭即使php执行完毕
        // $redis->setOption();//设置客户端选项
        // unset($redis);
        $redis = new \Redis;
        $redis->connect('127.0.0.1', 6379);
        // print_r($redis->getOption($parameter));
        $redis->delete('test');
        $redis->set('test', 'test');
        var_dump($redis->getSet('test', 'a'));
        print_r($redis->get('test'));
    }
    public function key() {
        // $redis = PhpRedis::connect();
        $redis = new \Redis;
        $redis->connect('127.0.0.1', 6379);
        //删除;
        $redis->delete('test');
        $redis->set('test', 'test');
        echo $redis->get('test') . "\n";
        $redis->setex('test', 2, 'a');
        echo $redis->get('test') . "\n";
        sleep(2);
        echo $redis->get('test') . "\n";

    }
}