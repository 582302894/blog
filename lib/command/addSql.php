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

$lastArticle = \think\Db::name('article')->order('id desc')->field('id')->find();
$lastArticleId = ($lastArticle == null) ? 0 : $lastArticle['id'];

/**

INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('1', '1', '1');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('2', '1', '2');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('3', '1', '3');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('4', '1', '4');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('5', '1', '5');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('6', '1', '6');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('7', '1', '7');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('8', '1', '8');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('9', '1', '9');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('10', '1', '10');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('11', '1', '11');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('12', '1', '12');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('13', '1', '13');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('14', '1', '14');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('15', '1', '15');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('16', '1', '16');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('17', '1', '17');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('18', '1', '18');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('19', '1', '19');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('20', '1', '20');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('21', '1', '21');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('22', '1', '22');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('23', '1', '23');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('24', '1', '24');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('25', '1', '25');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('26', '2', '26');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('27', '2', '27');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('28', '2', '28');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('29', '2', '29');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('30', '2', '30');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('31', '2', '31');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('32', '2', '32');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('33', '2', '33');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('34', '2', '34');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('35', '2', '35');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('36', '2', '36');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('37', '2', '37');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('38', '2', '38');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('39', '2', '39');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('40', '2', '40');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('41', '2', '41');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('42', '2', '42');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('43', '2', '43');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('44', '2', '44');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('45', '2', '45');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('46', '2', '46');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('47', '2', '47');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('48', '2', '48');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('49', '2', '49');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('50', '2', '50');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('51', '3', '51');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('52', '3', '52');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('53', '3', '53');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('54', '3', '54');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('55', '3', '55');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('56', '3', '56');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('57', '3', '57');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('58', '3', '58');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('59', '3', '59');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('60', '3', '60');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('61', '3', '61');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('62', '3', '62');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('63', '3', '63');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('64', '3', '64');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('65', '3', '65');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('66', '3', '66');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('67', '3', '67');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('68', '3', '68');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('69', '3', '69');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('70', '3', '70');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('71', '3', '71');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('72', '3', '72');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('73', '3', '73');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('74', '3', '74');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('75', '3', '75');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('76', '4', '76');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('77', '4', '77');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('78', '4', '78');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('79', '4', '79');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('80', '4', '80');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('81', '4', '81');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('82', '4', '82');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('83', '4', '83');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('84', '4', '84');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('85', '4', '85');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('86', '4', '86');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('87', '4', '87');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('88', '4', '88');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('89', '4', '89');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('90', '4', '90');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('91', '4', '91');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('92', '4', '92');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('93', '4', '93');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('94', '4', '94');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('95', '4', '95');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('96', '4', '96');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('97', '4', '97');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('98', '4', '98');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('99', '4', '99');
INSERT INTO `test`.`tag` (`id`, `type`, `name`) VALUES ('100', '4', '100');

 */

$tagId = \think\Db::name('tag')->field('id,type')->cache(3600)->select();
if ($tagId == null) {
    die('no tags data');
}
$tagIds = [];
$tagCount = [];
foreach ($tagId as $key => $id) {
    $tagIds[$id['type']][] = $id['id'];
    $tagCount[$id['type']] = isset($tagCount[$id['type']]) ? ($tagCount[$id['type']] + 1) : 1;
}

echo $lastArticleId . "\n\r";

for ($i = 1; $i <= 3000000; $i++) {
// for ($i = 1; $i <= 1000; $i++) {
    if (($i % 1000) == 0) {
        addDbData($lastArticleId + $i - 1000 + 1, $lastArticleId + $i);
        echo $i . "  " . number_format($i * 100 / 3000000, 1) . "\n";
    }
}
echo "end";

function addDbData($start, $end) {
    global $tagIds, $tagCount;
    $articleSql = "INSERT INTO `test`.`article` (`id`) VALUES ";
    $tag1Sql = "INSERT INTO `test`.`tag1` (`article_id`, `tag_id`) VALUES ";
    $tag2Sql = "INSERT INTO `test`.`tag2` (`article_id`, `tag_id`) VALUES ";
    $tag3Sql = "INSERT INTO `test`.`tag3` (`article_id`, `tag_id`) VALUES ";
    $tag4Sql = "INSERT INTO `test`.`tag4` (`article_id`, `tag_id`) VALUES ";
    for ($i = $start; $i <= $end; $i++) {
        $articleSql .= "(" . $i . "),";
        $tagId1 = $tagIds[1][$i % $tagCount[1]];
        $tagId2 = $tagIds[2][$i % $tagCount[2]];
        $tagId3 = $tagIds[3][$i % $tagCount[3]];
        $tagId4 = $tagIds[4][$i % $tagCount[4]];
        $tag1Sql .= "(" . $i . "," . $tagId1 . "),";
        $tag2Sql .= "(" . $i . "," . $tagId2 . "),";
        $tag3Sql .= "(" . $i . "," . $tagId3 . "),";
        $tag4Sql .= "(" . $i . "," . $tagId4 . "),";
        // // echo $tagId1 . '-' . $tagId2 . '-' . $tagId3 . '-' . $tagId4 . "\n";
    }
    $articleSql = substr($articleSql, 0, strlen($articleSql) - 1) . ";\n";
    $tag1Sql = substr($tag1Sql, 0, strlen($tag1Sql) - 1) . ";\n";
    $tag2Sql = substr($tag2Sql, 0, strlen($tag2Sql) - 1) . ";\n";
    $tag3Sql = substr($tag3Sql, 0, strlen($tag3Sql) - 1) . ";\n";
    $tag4Sql = substr($tag4Sql, 0, strlen($tag4Sql) - 1) . ";\n";
    $fp = fopen('./addDb.sql', 'a');
    fwrite($fp, $articleSql);
    fwrite($fp, $tag1Sql);
    fwrite($fp, $tag2Sql);
    fwrite($fp, $tag3Sql);
    fwrite($fp, $tag4Sql);
    fclose($fp);
}
