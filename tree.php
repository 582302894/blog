<?php

$removeLists = ['.git', 'vendor', 'public', 'qrcode'];

$path = __DIR__ . '/../blog';

function getTree($root) {
    global $removeLists;
    $fp = opendir($root);
    $dirs = [];
    while (($file = readdir($fp)) != false) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        if (is_dir($root . '/' . $file)) {
            if (in_array($file, $removeLists)) {
                continue;
            }
            $temp = getTree($root . '/' . $file);
            if ($temp == []) {
                $dirs[$file] = $file;
            } else {
                $dirs[$file] = $temp;
            }
        }
    }
    closedir($fp);
    return $dirs;
}

$tree = getTree($path);

function getArray($array, $str) {
    $lists = [];
    $hasChild = false;
    foreach ($array as $dir => $a) {
        $lists[] = $str . '|-' . $dir;
        if (is_array($a)) {
            $hasChild = true;
            $return = getArray($a, $str . '| ');
            foreach ($return as $key => $r) {
                $lists[] = $r;
            }
            continue;
        }
    }
    if ($hasChild == false) {
        $lists[] = "|";
    }
    return $lists;
}

$array = getArray($tree, '');

foreach ($array as $key => $a) {
    echo $a . "\n";
}
