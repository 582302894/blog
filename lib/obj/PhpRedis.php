<?php
namespace lib\obj;
use Predis;

class PhpRedis {
    static $config = null;
    static $connects = [];

    public static function connect() {
        $redisConfig = [
            'scheme' => config('redis')['scheme'],
            'host' => config('redis')['host'],
            'port' => config('redis')['port'],
        ];

        if (!empty($config)) {
            self::$config = array_merge($redisConfig, $config);
        } else {
            self::$config = $redisConfig;
        }
        $key = md5(serialize($redisConfig));
        if (isset(self::$connects[$key])) {
            return unserialize(self::$connects[$key]);
        } else {
            $redis = new Predis\Client($redisConfig);
            self::$connects[$key] = serialize($redis);
            return $redis;
        }
    }
}