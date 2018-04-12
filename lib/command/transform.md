##翻译文件

>暂时只写了处理cfg文件
>$GLOBALS['app'] = require __DIR__ . "/../common/private.php"; 存放百度翻译个人appid与secret
>function cache 用redis存储翻译过的内容存储一天，有redis更换地址与端口即可，没有的话就不会缓存已经翻译过的内容
>在命令行中执行命令 以下是在window git bash 下执行



翻译文件    phpPath/php path:transform.php -f path:file
>/d/web/php/php-5.4.45-nts/php /d/web/WWW/blog/lib/command/transform.php -f /c/Users/king/Desktop/bobclasses.cfg



翻译文件夹    phpPath/php path:transform.php -d dir:file
>/d/web/php/php-5.4.45-nts/php /d/web/WWW/blog/lib/command/transform.php -d /c/Users/king/Desktop/helmod_0.7.5/locale/en