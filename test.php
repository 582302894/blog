<?php

$data = [
    'a' => 'b',
];
$data = http_build_query($data);
$cookie = [
    'aaa' => 'aaa',
];
$cookie = http_build_query($cookie);
$opts = [
    'http' => [
        'method' => 'POST',
        'header' =>
        "Content-type: application/x-www-form-urlencoded\r\n" .
        "Cookie: " . $cookie . "\r\n" .
        "Content-Length:" . strlen($data) . "\r\n",
        'content' => $data,
    ],
];

$context = stream_context_create($opts);

$url = 'http://www.hanzi.com/test.php';
$result = file_get_contents($url, false, $context);
echo '<meta charset=utf-8><pre>';
var_dump(get_headers($url));
var_dump($result);
echo '</pre>';exit();