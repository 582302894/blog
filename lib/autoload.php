<?php
defined('COMPOSER_SCRIPT_PATH') or die('no define COMPOSER_SCRIPT_PATH');

$files = [
    COMPOSER_SCRIPT_PATH . '/lib/config.php',
    COMPOSER_SCRIPT_PATH . '/lib/common/funciton.php',
    COMPOSER_SCRIPT_PATH . '/vendor/autoload.php',
    COMPOSER_SCRIPT_PATH . '/lib/obj/route.php',
    COMPOSER_SCRIPT_PATH . '/lib/obj/Db.php',
    COMPOSER_SCRIPT_PATH . '/lib/obj/view.php',

    COMPOSER_SCRIPT_PATH . '/lib/obj/cache.php',
    COMPOSER_SCRIPT_PATH . '/lib/obj/log.php',

    COMPOSER_SCRIPT_PATH . '/lib/common/helper.php',
];

foreach ($files as $file) {
    require_once $file;
}

try {
    if (defined('PHP_CLI') == false) {
        // error_reporting(0);
        // register_shutdown_function("fatal_handler");
        // set_error_handler("error_handler");
    }
    \lib\obj\Db::run();
    \lib\obj\route::run();
} catch (\Exception $e) {
    \lib\obj\log::exception($e);
    if (Config('ENV_DEBUG') === true) {
        show($e);
    }
    echo $e->getMessage();
    // show($e);
}
