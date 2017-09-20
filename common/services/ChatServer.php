<?php
namespace common\services;
require dirname(__DIR__) . '/../vendor/autoload.php';
require dirname(__DIR__) . '/../vendor/yiisoft/yii2/Yii.php';
require dirname(__DIR__) . '/config/bootstrap.php'; // 注意: yii的自动加载依赖根别名, 所以这里需引入启动文件

use Ratchet\Server\IoServer;

$chatService = new \common\services\ChatService();
$server = IoServer::factory($chatService, 8080);

$server->run();