<?php

namespace lib\app\test\server;

use lib\obj\cache;

class find {

    private $path = "D:\\web\\WWW\\hanzi\\public\\lib\\app\\test\\server\\qrcode";

    private $files = [];

    public function getfiles() {
        $path = $this->path;
        isDir($path);
        $phpFiles = $this->getPhpFiles($path);
    }

    /**
     * [getPhpFiles description]
     * @return [type] [description]
     */
    public function getPhpFiles($path) {
        isDir($path);
        $files = openDirs($path, ['php']);
        $files = deleteEmpty($files);
        $this->eachFile($files, '');

        foreach ($this->files as $path => $root) {
            $this->checkFile($root, $path);
        }
        show($this->files);
    }

    public function eachFile($files, $root) {
        foreach ($files as $name => $file) {
            if (is_array($file)) {
                $this->eachFile($file, $root . '/' . $name);
            } else {
                $this->files[$root . '/' . $name] = $this->path . $root . '/' . $name;
            }
        }
    }

    public function checkFile($root, $path = '') {
        if ($path == '') {
            $path = md5($root);
        }
        $key = 'content_' . $path;
        $content = cache::get($key);
        if ($content == false) {
            $content = file_get_contents($root);
            cache::set($key, $content, 3600);
        }
        $result = $this->hasNoBlock($content);
    }

    public function hasNoBlock($content) {

        $oneStrPos = getStrPos($content, 'function');
        $twoStrPos = getStrPos($content, '}');
        $threeStrPos = getStrPos($content, '(');
        $fourStrPos = getStrPos($content, '@param');
        $fiveStrPos = getStrPos($content, '@return');
        $sixStrPos = getStrPos($content, ' return');
        $sevenStrPos = getStrPos($content, '/*');

        $onePro = 0;
        $twoPro = 0;
        $threePro = 0;
        $fourPro = 0;
        $fivePro = 0;
        $sixPro = 0;

        $count = 0;
        for ($one = 0; $one < count($oneStrPos); $one++) {
            $end = false;
            //找出function前的/*出现位置
            for ($seven = 0; $seven < count($sevenStrPos); $seven++) {
                if ($sevenStrPos[$seven] < $oneStrPos[$one]) {
                    $resultFunct[$one]['beginNote'] = $sevenStrPos[$seven];
                } else {
                    if (!isset($resultFunct[$one])) {
                        $resultFunct[$one] = [];
                    }
                    break;
                }
            }
            if (!isset($resultFunct[$one]['beginNote'])) {
                continue;
            }
            for ($four = 0; $four < count($fourStrPos); $four++) {
                if ($fourStrPos[$four] > $oneStrPos[$one]) {
                    break;
                }
                if ($fourStrPos[$four] > $resultFunct[$one]['beginNote']) {
                    $resultFunct[$one]['param'][] = $fourStrPos[$four];
                }
            }
            for ($two = 0; $two < count($twoStrPos); $two++) {
                
            }
        }

        foreach ($resultFunct as $key => $resultF) {
            if (!isset($resultF['endStart'])) {
                continue;
            }
            $resultFunct[$key]['content'] = mb_substr($content, $resultF['beginNote'], $resultF['endStart']);
        }
        show($twoStrPos, false);
        show($oneStrPos, false);
        show($resultFunct, false);
        // show($sevenStrPos, false);
        // show($oneStrPos, false);
        // show(htmlentities($content));
        die();
    }

}