<?php

namespace lib\obj;

class view {
    public static function show($path = '', $args = []) {
        if ($path == '') {
            $path = 'index/index/index';
            if (isset($_GET['s'])) {
                $path = $_GET['s'];
            }
        }
        $result = explode('/', $path);
        $m = 'index';
        $a = 'index';
        $v = 'index';
        if (count($result) == 1) {
            $v = $path;
        } elseif (count($result) == 2) {
            $a = $result[0];
            $v = $result[1];
        } elseif (count($result) == 3) {
            $m = $result[0];
            $a = $result[1];
            $v = $result[2];
        } else {
            throw new \Exception("模版文件不存在:" . $path);
        }
        $tpl = COMPOSER_SCRIPT_PATH . '/lib/app/' . $m . '/view/' . $a . '/' . $v . '.html';
        if (!file_exists($tpl)) {
            throw new \Exception("模版文件不存在:" . $tpl);
        }
        require_once COMPOSER_SCRIPT_PATH . '/vendor/smarty/smarty/libs/Smarty.class.php';
        $smarty = new \Smarty;
        $smarty->debugging = false;
        $smarty->caching = true;
        $smarty->compile_dir = COMPOSER_SCRIPT_PATH . '/lib/runtime/cache/smarty/template';
        $smarty->cache_dir = COMPOSER_SCRIPT_PATH . '/lib/runtime/cache/smarty/cache';
        $smarty->left_delimiter = config('smarty')['left'];
        $smarty->right_delimiter = config('smarty')['right'];
        $smarty->cache_lifetime = 120;
        foreach ($args as $key => $value) {
            $smarty->assign($key, $value);
        }
        ob_start();
        $smarty->display($tpl);
        $content = ob_get_contents();
        ob_clean();
        return $content;
    }
}