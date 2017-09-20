<?php
namespace common\lib;

use Monolog\Logger as Monologger;

/*
 * 通用日志类
 * 调用示例:
 * Logger::instance($channelName)->log($logLevel, $logMsg);
 * 根据日志等级可简写调用:
 * Logger::instance($channelName)->debug($logMsg);          // debug level
 * Logger::instance($channelName)->info($logMsg);           // info level
 * Logger::instance($channelName)->notice($logMsg);         // notice level
 * Logger::instance($channelName)->warn($logMsg);           // warning level
 * Logger::instance($channelName)->error($logMsg);          // error level
 * Logger::instance($channelName)->critical($logMsg);       // critical level
 * Logger::instance($channelName)->alert($logMsg);          // alert level
 * Logger::instance($channelName)->emergency($logMsg);      // emergency level
 * 说明:
 * channelName在项目配置文件中配置, 目前定义了四种频道用来区分不同日志, 可扩展
 * 分别为:
 * main => 默认频道, 可存放一些自定义业务日志
 * db => 数据库日志
 * exception => 程序运行异常日志
 * route => 路由日志
 * */
class Logger
{

    private static $_logInstance;

    public static function instance($channel = '')
    {
        if(empty($channel)) {
            $channel = 'main';
        }
        self::$_logInstance = \Yii::$app->monolog->getLogger($channel);
        return self::$_logInstance;
    }

}