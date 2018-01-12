```
|-lib                   项目应用文件
| |-app                 应用
| | |-index             index 模块
| | | |-view            视图
|
| | |-test              test 模块
| | | |-model           模型
| | | |-server          服务
| | | |-view            视图
| | | | |-test          
| | | | |-workerman
|
| |-command             执行命令脚本
| | |-workerman         执行命令 workerman类
|
| |-common              公用配置文件、方法
| |-obj                 应用类文件
| | |-driver            
| | | |-cache
| |-runtime             缓存文件
| | |-cache
|             
| | | |-data
| | | |-smarty          smart模版缓存路径
| | | | |-cache
| | | | |-template
|
| | |-workerman         workerman缓存文件
```

数据库 blog_test
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `con_id` varchar(50) NOT NULL DEFAULT '',
  `online_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '上下线',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `online_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `close_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `con_id` (`con_id`) USING HASH,
  UNIQUE KEY `username` (`username`,`online_status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;