<?php

$i = 0;

while (1) {
    $fp = fopen(__DIR__ . '/log/input.txt', 'a');
    $str = trim(fgets(STDIN));
    if ($str == 'exit') {
        fclose($fp);
        break;
    }
    fwrite($fp, $str . "\n");
}
if (!$fp) {
    fclose($fp);
}