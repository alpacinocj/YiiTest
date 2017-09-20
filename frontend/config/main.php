<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',                                 // 应用标识ID
    'basePath' => dirname(__DIR__),                         // 应用更目录, 也可使用该应用根目录别名@frontend
    'bootstrap' => ['log'],                                 // 配置启动阶段需要运行的组件
    //'catchAll' => ['test/test'],                            // 制定处理所有请求的控制器方法, 通常在维护模式下使用
    'controllerNamespace' => 'frontend\controllers',        // 制定控制器默认命名空间
    // 注册应用组件, 可通过表达式\Yii::$app->componentId全局访问
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                // trace level log
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['trace'],
                    'logVars' => [],
                    'logFile' => '@frontend_logs/trace_' . date('Ymd') . '.log',
                ],
                // info level log
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logVars' => [],
                    'logFile' => '@frontend_logs/info_' . date('Ymd') . '.log',
                ],
                // warning level log
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logVars' => [],
                    'logFile' => '@frontend_logs/warning_' . date('Ymd') . '.log',
                ],
                // error level log
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logVars' => [],
                    'logFile' => '@frontend_logs/error_' . date('Ymd') . '.log',
                ],
                // profile level log (custom log)
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['profile'],
                    'logVars' => [],
                    'logFile' => '@frontend_logs/profile_' . date('Ymd') . '.log',
                ],
                // database category log
                [
                    'class' => 'yii\log\FileTarget',
                    'logVars' => [],
                    'categories' => ['yii\db\*'],
                    'logFile' => '@frontend_logs/db_' . date('Ymd') . '.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>' => '<controller>/index',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    // 配置可全局参数, 可通过\Yii::$app->params[key]来访问
    'params' => $params,
    // 请求处理之前的配置(1)
    'on beforeRequest' => function($event) {
        //echo 'before request' . "\n";
        // 过滤请求参数
        if(\Yii::$app->request->getIsGet() && ($getParams = \Yii::$app->request->get())) {
            foreach($getParams as $k=>$v) {
                $getParams[$k] = trim($v);
            }
        }
    },
    // 控制器动作处理之前的配置(2) 后台模块可以用于一些权限检查
    'on beforeAction' => function(\yii\base\ActionEvent $event) {
        //echo 'before action' . "\n";
        //$event->isValid = false;      // 之后的事件不会被触发
    },
    // 控制器动作处理之后的配置(3)
    'on afterAction' => function(\yii\base\ActionEvent $event) {
        //echo 'after action' . "\n";
    },
    // 请求处理之后的配置(4)
    'on afterRequest' => function($event) {
        //echo 'after request' . "\n";
    },
];
