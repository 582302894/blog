<?php
namespace composer;

define('PHP_CLI', true);
define('COMPOSER_SCRIPT_PATH', __DIR__);

require COMPOSER_SCRIPT_PATH . '/lib/autoload.php';
$dbCoinfig = [
    'hostname' => '127.0.0.1',
    'database' => 'yingxiao',
    'username' => 'root',
    'password' => 'root',
];
\lib\obj\Db::run($dbCoinfig);

$temp = \think\Db::name('yx_knowledge')->field('id')->select();
$countHelp = count($temp);

// for ($i = 1; $i <= 1000000; $i++) {
for ($i = 1; $i <= 2000; $i++) {
    if (($i % 2000) == 0) {
        addDbData($lastId + $i - 2000 + 1, $lastId + $i);
        echo $i . "  " . number_format($i * 100 / 10000000, 1) . "\n";
    }
}

echo "end";

function addDbData($start, $end) {
    $time = time();
    $sql = "INSERT INTO `yx_tj_puv` ( `tj_id`, `type`, `pv`, `uv`, `user_pv`, `user_uv`, `ymd`, `create_t`, `update_t`, `type_device`, `ymd_time`) VALUES ;"
    for ($i = $start; $i <= $end; $i++) {
        $sq .= " ('641', '3', '1', '1', '0', '0', '2018-01-26', '2018-01-26 19:43:48', '2018-01-26 19:43:48', '1', '1516896000')";
        $sql .= "('" . rand(1, 108) . "', " . rand(1, 10000) . ", '" . date('Y-m-d H:i:s') . "', '1'),";
    }
    $sql = substr($sql, 0, strlen($sql) - 1) . ";\n";
    $fp = fopen('./addDb.sql', 'a');
    fwrite($fp, $sql);
    fclose($fp);
}
