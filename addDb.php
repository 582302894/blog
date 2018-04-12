<?php
namespace composer;

define('PHP_CLI', true);
define('COMPOSER_SCRIPT_PATH', __DIR__);

require COMPOSER_SCRIPT_PATH . '/lib/autoload.php';

$dbCoinfig = [
    'hostname' => '127.0.0.1',
    'database' => 'test',
    'username' => 'root',
    'password' => 'root',
];
\lib\obj\Db::run($dbCoinfig);

$lastId = 0;

for ($i = 1; $i <= 1000000; $i++) {
// for ($i = 1; $i <= 2000; $i++) {
    if (($i % 2000) == 0) {
        addDbData($lastId + $i - 2000 + 1, $lastId + $i);
        echo $i . "  " . number_format($i * 100 / 10000000, 1) . "\n";
    }
}

echo "end";

function addDbData($start, $end) {
    $time = time();
    $sql = "INSERT INTO `yx_product_article_tag` (`tag_id`, `article_id`, `create_t`, `status`) VALUES ";
    for ($i = $start; $i <= $end; $i++) {
        $sql .= "('" . rand(1, 108) . "', " . rand(1, 10000) . ", '" . date('Y-m-d H:i:s') . "', '1'),";
    }
    $sql = substr($sql, 0, strlen($sql) - 1) . ";\n";
    $fp = fopen('./addDb.sql', 'a');
    fwrite($fp, $sql);
    fclose($fp);
}
