<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'think\\' => array($vendorDir . '/topthink/think-validate/src', $vendorDir . '/topthink/think-orm/src', $vendorDir . '/topthink/think-template/src'),
    'my\\' => array($baseDir . '/src'),
    'lib\\obj\\' => array($baseDir . '/lib/obj'),
    'Workerman\\' => array($vendorDir . '/workerman/workerman'),
    'Psr\\Log\\' => array($vendorDir . '/psr/log/Psr/Log'),
    'Predis\\' => array($vendorDir . '/predis/predis/src'),
    'PHPMailer\\PHPMailer\\' => array($vendorDir . '/phpmailer/phpmailer/src'),
    'Monolog\\' => array($vendorDir . '/monolog/monolog/src/Monolog'),
    'Doctrine\\Common\\Cache\\' => array($vendorDir . '/doctrine/cache/lib/Doctrine/Common/Cache'),
);
