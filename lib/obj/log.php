<?php

namespace lib\obj;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class log {

    public static function checkPath() {
        $logPath = COMPOSER_SCRIPT_PATH . '/lib/runtime/log/' . date('Y-m');
        if (!is_dir($logPath)) {
            mkdir($logPath, 777, true);
        }
        return $logPath . '/' . date('d');
    }

    public static function error($errorInfo) {
        $logger = new Logger('log');
        $logFile = self::checkPath();
        $logger->pushHandler(new StreamHandler($logFile, Logger::ERROR));
        $logger->addError($errorInfo);
    }

    public static function bug($bugInfo) {
        $logger = new Logger('log');
        $logFile = self::checkPath();
        $logger->pushHandler(new StreamHandler($logFile, Logger::DEBUG));
        $logger->addError($bugInfo);
    }

    public static function exception($e) {
        $logger = new Logger('log');
        $logFile = self::checkPath();
        $logger->pushHandler(new StreamHandler($logFile, Logger::DEBUG));
        $errMessage = [
            $e->getMessage(),
            '文件:' . $e->getFile(),
            $e->getLine() . '行',
            'errorCode:' . $e->getCode(),
        ];
        $logger->addError(implode(', ', $errMessage), $e->getTrace());
    }

    public static function fatalError($e) {
        $logger = new Logger('log');
        $logFile = self::checkPath();
        $logger->pushHandler(new StreamHandler($logFile, Logger::DEBUG));
        $errMessage = [
            $e['message'],
            '文件:' . $e['file'],
            $e['line'] . '行',
            'errorType:' . $e['type'],
        ];
        $logger->addError(implode(', ', $errMessage));
    }

}