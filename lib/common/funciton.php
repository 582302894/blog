<?php

function show() {
    $args = func_get_args();
    // echo '<meta charset=utf-8><pre>';
    $hasFalse = false;
    $argsCount = count($args);
    $count = 0;
    foreach ($args as $arg) {
        $count++;
        if ($arg == false && $argsCount != 1 && $count == $argsCount) {
            $hasFalse = true;
            break;
        }
        var_dump($arg);
    }
    // echo '</pre>';
    if ($hasFalse == false) {
        exit();
    }
}

function isDir($path) {
    if (!is_dir($path)) {
        throw new \Exception("bad path:" . $path);
    }
}

/**
 * 遍历文件夹
 * @param  [type] $dir  [description]
 * @param  array  $type 类型筛选项
 * @return [type]       [description]
 */
function openDirs($dir, $type = []) {
    $fp = opendir($dir);
    $dirs = [];
    if (!is_array($type)) {
        $type = [];
    }
    while (($file = readdir($fp)) != false) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        $temp = $dir . '/' . $file;
        if (is_dir($temp)) {
            $dirs[$file] = openDirs($temp, $type);
        } else {
            $info = pathinfo($file);
            if (
                $type == [] ||
                (isset($info['extension']) && in_array($info['extension'], $type))
            ) {
                $dirs[$file] = $file;
            }
        }
    }
    closedir($fp);
    return $dirs;
}

/**
 * 去除空值
 * @param  array  $root [description]
 * @return [type]       [description]
 */
function deleteEmpty($root = []) {
    $arr = [];
    foreach ($root as $key => $r) {
        if (!empty($r)) {
            if (is_array($r)) {
                $return = deleteEmpty($r);
                if (!empty($return)) {
                    $arr[$key] = deleteEmpty($r);
                }
            } else {
                $arr[$key] = $r;
            }
        }
    }
    return $arr;
}

function Config($name = '') {
    if (!isset($GLOBAL_CONFIGS)) {
        static $GLOBAL_CONFIGS;
        $temp = require COMPOSER_SCRIPT_PATH . '/lib/common/config.php';
        $GLOBAL_CONFIGS = $temp;
    }
    $configs = $GLOBAL_CONFIGS;
    if ($name == '') {
        return $configs;
    }
    return $configs[$name];
}

/**
 * 获得字符串出现的位置
 * @param  [type] $haystack [description]
 * @param  [type] $needle   [description]
 * @return [type]           [description]
 */
function getStrPos($haystack = '', $needle = '') {
    if ($needle == '') {
        return false;
    }
    $offset = 0;
    while (1) {
        $pos = strpos($haystack, $needle, $offset);
        if ($pos !== false) {
            $strPos[] = $pos;
            $offset = $pos + 1;
        } else {
            break;
        }
    }
    if ($offset == 0) {
        return false;
    }
    return $strPos;
}