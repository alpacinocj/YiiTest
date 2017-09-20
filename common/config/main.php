<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yiitest',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session' => [
            'class' => 'yii\web\DbSession',         // 配置SESSION存储方式为数据库存储
            'db' => 'db',                           // 数据库连接组件ID, 默认为'db'
            'sessionTable' => 'session',            // SESSION存储数据表名称, 默认为'session'
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                        'error' => 'error.php',
                    ],
                ],
            ]
        ],
        'monolog' => [
            'class' => '\Mero\Monolog\MonologComponent',
            'channels' => [
                'main' => [
                    'handler' => [
                        [
                            'type' => 'stream',
                            'formatter' => new \Monolog\Formatter\JsonFormatter(),
                            'path' => '@app/runtime/logs/main/' . date('Ym') . '/main_' . date('d') . '.log',
                        ]
                    ],
                    'processor' => [],
                ],
                'db' => [
                    'handler' => [
                        [
                            'type' => 'stream',
                            'formatter' => new \Monolog\Formatter\JsonFormatter(),
                            'path' => '@app/runtime/logs/db/' . date('Ym') . '/db_' . date('d') . '.log',
                        ]
                    ],
                    'processor' => [],
                ],
                'route' => [
                    'handler' => [
                        [
                            'type' => 'stream',
                            'formatter' => new \Monolog\Formatter\JsonFormatter(),
                            'path' => '@app/runtime/logs/route/' . date('Ym') . '/route_' . date('d') . '.log',
                        ]
                    ],
                    'processor' => [
                        function($record) {
                            $processor = new \Monolog\Processor\WebProcessor();
                            $processor->addExtraField('query', 'QUERY_STRING');
                            $processor->addExtraField('user_agent', 'HTTP_USER_AGENT');
                            return $processor->__invoke($record);
                        },
                    ],
                ],
                'exception' => [
                    'handler' => [
                        [
                            'type' => 'stream',
                            'formatter' => new \Monolog\Formatter\JsonFormatter(),
                            'path' => '@app/runtime/logs/exception/' . date('Ym') . '/exception_' . date('d') . '.log',
                        ]
                    ],
                    'processor' => [],
                ],
            ],
        ],
    ],
];
