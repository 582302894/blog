<?php
namespace lib\obj;

class route {

    public static function run() {
        $route = 'index/index/index';
        if (isset($_GET['s'])) {
            $route = $_GET['s'];
        }
        if (isset($pathinfo['extension'])) {
        }
        $result = explode('/', $route);
        if (count($result) != 3) {
            throw new \Exception("路径s错误:" . $route);
        }
        $m = $result[0];
        $c = $result[1];
        $a = $result[2];
        define('APP_MODEL', $m);
        define('APP_CONTROLLER', $c);
        define('APP_ACTION', $a);
        define('APP_VIEW', $a);
        require_once COMPOSER_SCRIPT_PATH . '/lib/app/' . $m . '/' . $c . '.php';
        $class = "\lib\app\\" . $m . "\\" . $c;
        $app = new $class();
        $return = call_user_func(array($app, $a));
        if (is_string($return)) {
            header('Content-type:text/html;charset=utf-8');
            echo $return;
        }
        if (is_array($return) || is_object($return)) {
            show($return);
        }
    }
}