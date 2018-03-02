###百万数据 文章标签列表筛选数据库查询优化
2018-03-02 15:05:21
优化结果：有标签选择时数据查询3s之内,之后的优化我现在无能为力

查询1个标签耗时1.12s
```javascript
SELECT
  t1.article_id,a.id
FROM
  tag1 t1
LEFT JOIN article a on a.id=t1.article_id
WHERE
  t1.tag_id = 1
LIMIT 100000,
 10
```

查询2个标签耗时1.94s
```javascript
SELECT
  t1.article_id,a.id
FROM
  tag1 t1
LEFT JOIN tag2 t2 ON t1.article_id = t2.article_id
LEFT JOIN article a on a.id=t1.article_id
WHERE
  t1.tag_id = 1
AND t2.tag_id = 26
LIMIT 100000,
 10
```

查询3个标签耗时2.55s
```javascript
SELECT
  t1.article_id,a.id
FROM
  tag1 t1
LEFT JOIN tag2 t2 ON t1.article_id = t2.article_id
LEFT JOIN tag3 t3 ON t1.article_id = t3.article_id
LEFT JOIN article a on a.id=t1.article_id
WHERE
  t1.tag_id = 1
AND t2.tag_id = 26
AND t3.tag_id = 51
LIMIT 100000,
 10
```

查询4个标签耗时 2.98s
```javascript
SELECT
  t1.article_id,a.id
FROM
  tag1 t1
LEFT JOIN tag2 t2 ON t1.article_id = t2.article_id
LEFT JOIN tag3 t3 ON t1.article_id = t3.article_id
LEFT JOIN tag4 t4 ON t1.article_id = t4.article_id
LEFT JOIN article a on a.id=t1.article_id
WHERE
  t1.tag_id = 1
AND t2.tag_id = 26
AND t3.tag_id = 51
AND t4.tag_id = 76
LIMIT 100000,
 10
```



###数据库test  数据表sql
量级数据从addDb.php 运行得到
tag表中数据在addDb.php中
插入量级数据后再添加表索引
300W article
300W tag1
300W tag2
300W tag3
300W tag4
耗时 150s
```javascript
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1,2,3,4',
  `name` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `tag1`;
CREATE TABLE `tag1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `tag2`;
CREATE TABLE `tag2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `tag3`;
CREATE TABLE `tag3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `tag4`;
CREATE TABLE `tag4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;
```



插入索引耗时40s
```javascript
ALTER TABLE `tag1`
ADD INDEX (`article_id`, `tag_id`) ,
ADD INDEX (`tag_id`) ;
ALTER TABLE `tag2`
ADD INDEX (`article_id`, `tag_id`) ,
ADD INDEX (`tag_id`) ;
ALTER TABLE `tag3`
ADD INDEX (`article_id`, `tag_id`) ,
ADD INDEX (`tag_id`) ;
ALTER TABLE `tag4`
ADD INDEX (`article_id`, `tag_id`) ,
ADD INDEX (`tag_id`) ;
```


