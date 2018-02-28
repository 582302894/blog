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

$lastFllow = \think\Db::name('yx_follow')->order('id desc')->field('id')->find();
$lastFllowId = $lastFllow['id'];

$tagId = \think\Db::name('yx_product_tag')->field('id,tag_type')->cache(3600)->select();
// $tagIds = [];
// $tagCount = [];
// foreach ($tagId as $key => $id) {
//     $tagIds[$id['tag_type']][] = $id['id'];
//     $tagCount[$id['tag_type']] = isset($tagCount[$id['tag_type']]) ? ($tagCount[$id['tag_type']] + 1) : 1;
// }

echo $lastFllowId . "\n\r";

for ($i = 1; $i <= 3000000; $i++) {
// for ($i = 1; $i <= 1000000; $i++) {
    if (($i % 1000) == 0) {
        addDbData($lastFllowId + $i - 1000 + 1, $lastFllowId + $i);
        echo $i . "  " . number_format($i * 100 / 1000000, 1) . "\n";
    }
}
echo "end";

function addDbData($start, $end) {
    // global $tagIds, $tagCount;
    $sql = '';
    for ($i = $start; $i <= $end; $i++) {
        $date = date('Y-m-d H:i:s', time() + $start);
        // $sql .= "insert yx_product_article (`id`,`title`,`description`,`content`,`create_time`,`modify_time`,`status`) values (" . $i . "," . $i . "," . $i . "," . $i . ",'" . $date . "','" . $date . "',2);\n";
        // $tagId1 = $tagIds[1][$i % $tagCount[1]];
        // $tagId2 = $tagIds[2][$i % $tagCount[2]];
        // $tagId3 = $tagIds[3][$i % $tagCount[3]];
        // $tagId4 = $tagIds[4][$i % $tagCount[4]];
        // // echo $tagId1 . '-' . $tagId2 . '-' . $tagId3 . '-' . $tagId4 . "\n";
        // $sql .= "insert yx_product_article_tag (`tag_id`,`article_id`) values (" . $tagId1 . "," . $i . ");\n";
        // $sql .= "insert yx_product_article_tag (`tag_id`,`article_id`) values (" . $tagId2 . "," . $i . ");\n";
        // $sql .= "insert yx_product_article_tag (`tag_id`,`article_id`) values (" . $tagId3 . "," . $i . ");\n";
        // $sql .= "insert yx_product_article_tag (`tag_id`,`article_id`) values (" . $tagId4 . "," . $i . ");\n";
        // $sql .= "\n";

        $sql .= "INSERT INTO `yingxiao`.`yx_follow` (`id`, `userid`, `author_id`, `create_time`, `update_time`, `type`) VALUES (" . $start . ", '" . $start . "', " . $start . ", '" . $date . "', '" . $date . "', '1');\n";

    }
    $fp = fopen('./addDb.sql', 'a');
    fwrite($fp, $sql);
    fclose($fp);
}
