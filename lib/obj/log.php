<?php

namespace lib\obj;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class log {

    /**
     * 检查日志目录文件
     * @param  string $prefix [description]
     * @return [type]         [description]
     */
    public static function checkPath($prefix = '') {
        $basePath = COMPOSER_SCRIPT_PATH . '/lib/runtime';
        if (!is_writable($basePath)) {
            throw new \Exception("log path can't be written");
        }
        $logPath = COMPOSER_SCRIPT_PATH . '/lib/runtime/log/' . date('Y-m');
        if (!is_dir($logPath)) {
            mkdir($logPath, 777, true);
        }
        if ($prefix == '') {
            return $logPath . '/' . date('d');
        }
        return $logPath . '/' . date('d') . '_' . $prefix;

    }

    /**
     * 记录错误
     * @param  [type] $errorInfo [description]
     * @return [type]            [description]
     */
    public static function error($errorInfo) {
        $logger = new Logger('log');
        $logFile = self::checkPath();
        $logger->pushHandler(new StreamHandler($logFile, Logger::ERROR));
        $logger->addError($errorInfo);
    }

    /**
     * 记录bug级别错误
     * @param  [type] $bugInfo [description]
     * @return [type]          [description]
     */
    public static function bug($bugInfo) {
        $logger = new Logger('log');
        $logFile = self::checkPath();
        $logger->pushHandler(new StreamHandler($logFile, Logger::DEBUG));
        $logger->addError($bugInfo);
    }

    /**
     * 记录异常错误
     * @param  [type] $e [description]
     * @return [type]    [description]
     */
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

    /**
     * 记录fatalError错误
     * @param  [type] $e [description]
     * @return [type]    [description]
     */
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

    /**
     * 记录低等级错误
     * @param  [type] $e [description]
     * @return [type]    [description]
     */
    public static function notice($e) {
        $logger = new Logger('log');
        $logFile = self::checkPath('notice');
        $logger->pushHandler(new StreamHandler($logFile, Logger::NOTICE));
        $errMessage = [
            $e['message'],
            '文件:' . $e['file'],
            $e['line'] . '行',
            'errorType:' . $e['type'],
        ];
        $logger->addError(implode(', ', $errMessage));
    }

}