<?php


$url = 'http://127.0.0.1/web/baidu/yingxiao/v2/home/product/details/id/685';

for ($i = 0; $i < 10; $i++) {
    file_get_contents($url);
}
die('die');