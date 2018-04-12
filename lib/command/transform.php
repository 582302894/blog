<?php

$GLOBALS['app'] = require __DIR__ . "/../common/private.php";
class ENV {
    public static $hasCache = null;
    public static $redisConnect = null;
}
function cache($key = false, $value = false, $type = 'get') {
    if (empty($key)) {
        return false;
    }
    if (ENV::$hasCache === null) {
        ENV::$hasCache = false;
        if (class_exists('Redis')) {
            $redis = new Redis();
            $flag = $redis->connect('127.0.0.1', 6379);
            if ($flag) {
                ENV::$hasCache = true;
                ENV::$redisConnect = $redis;
            }
        }
    }
    if (ENV::$hasCache === true) {
        if ($type == 'get') {
            return ENV::$redisConnect->get($key);
        }
        return ENV::$redisConnect->set($key, $value, 3600 * 24);
    }
    return false;
}

class Transform {

    const API_URL = 'http://api.fanyi.baidu.com/api/trans/vip/translate';
    const EN = 'en';
    const ZH = 'zh';
    const AUTO = 'auto';
    const TIMEOUT = 6;

    public static function tranCh($input) {
        if ($input == false) {
            return false;
        }
        foreach ($input as $key => $word) {
            $ouput[$key] = self::httpGet($word, self::ZH, self::EN);
        }
        return $ouput;
    }

    public static function httpGet($word, $forChar, $toChar) {
        $md5Key = md5(json_encode($word));
        $cache = cache($md5Key);
        if ($cache != false && $cache !== true) {
            return $cache;
        }
        $q = $word;
        $from = $forChar;
        $to = $toChar;
        $appid = $GLOBALS['app']['baidu_transform']['appid'];
        $secret = $GLOBALS['app']['baidu_transform']['secret'];
        $salt = rand(1000000000, 1999999999);
        $str1 = $appid . $q . $salt . $secret;
        $sign = md5($str1);
        $query = [
            'q' => $q,
            'from' => $from,
            'to' => $to,
            'appid' => $appid,
            'salt' => $salt,
            'sign' => $sign,
        ];
        $url = self::API_URL . '?' . http_build_query($query);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($res, true);
        if (isset($data['error_code'])) {
            throw new \Exception($data['error_msg'], $data['error_code']);
        }
        $str = [];
        foreach ($data['trans_result'] as $value) {
            $str[] = $value['dst'];
        }
        $str = implode("\n", $str);
        cache($md5Key, $str, 'set');
        return $str;
    }

    public static function fileTran($file, $outputDir = null) {
        if (!is_file($file)) {
            exit('is not a file or file not exit');
        }
        $fileInfo = pathinfo($file);
        $type = $fileInfo['extension'];
        $function = 'get' . ucwords($type) . "Word";
        $words = self::$function($file);

        $origin = $words['origin'];
        $left = $words['left'];
        $right = $words['right'];

        $str = implode("\n", $right);

        $res = self::httpGet($str, self::EN, self::ZH);
        $trans = explode("\n", $res);

        $function = 'save' . ucwords($type) . 'Word';

        $outputFile = $fileInfo['dirname'] . "/";
        if ($outputDir != null) {
            $outputFile = $outputDir . "/";
        }
        $outputFile .= $fileInfo['filename'] . "-" . self::ZH . "." . $fileInfo['extension'];

        self::$function($origin, $left, $trans, $outputFile);
    }

    public static function directoryTran($dir) {
        $fp = opendir($dir);
        if ($fp) {
            $pathinfp = pathinfo($dir);
            $path = $pathinfp['dirname'] . "/" . self::ZH;
            if (!file_exists($path)) {
                mkdir($path);
            }
            while (($file = readdir($fp)) !== false) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                if (is_dir($dir . "/" . $file)) {
                    continue;
                }
                self::fileTran($dir . "/" . $file, $path);
            }
        }
        closedir($fp);
    }

    public static function getCfgWord($file) {
        $fp = fopen($file, 'r');
        $originWords = [];
        while (($data = fgets($fp)) != false) {
            $originWords[] = str_replace(array("\n", "\r"), array("", ""), $data);
        }
        fclose($fp);
        foreach ($originWords as $key => $originWord) {
            $words['origin'][$key] = $originWord;
            $end = strpos($originWord, "=");
            if ($end) {
                $words['left'][$key] = substr($originWord, 0, $end);
                $words['right'][$key] = substr($originWord, $end + 1);
            }
        }
        return $words;
    }

    public static function saveCfgWord($origin, $left, $right, $outputFile) {
        $fp = fopen($outputFile, 'w');
        $i = 0;
        foreach ($origin as $key => $value) {
            $str = $value;
            if (isset($left[$key])) {
                $str = $left[$key] . "=" . $right[$i++];
            }
            fwrite($fp, $str . "\n");
        }
        echo "save file: " . $outputFile . "\n";
        fclose($fp);
    }

}

$param = getopt('d:f:');
$option = null;
if (isset($param['d'])) {
    $option = 'directoryTran';
    $arg = $param['d'];
}
if (isset($param['f'])) {
    $option = 'fileTran';
    $arg = $param['f'];
}

if ($option == null) {
    exit('not file or not directory');
}

Transform::$option($arg);
