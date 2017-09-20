<?php
namespace frontend\controllers;

use common\models\User;

/*
 * 过滤器的使用
 * */
class BehaviorController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    // 静态绑定行为, 重载yii\base\Components的behaviors方法
    public function behaviors()
    {
        return [
            'pageCache' => [
                'class' => '\yii\filters\PageCache',            // 指定类名
                'only' => ['page-cache'],                       // 仅限指定的操作
                'duration' => 1000,                             // 缓存时间
                'dependency' => [                               // 缓存失效的依赖
                    'class' => '\yii\caching\DbDependency',
                    'sql' => 'SELECT MAX(id) FROM ' . User::tableName(),
                ],
            ],
            'httpCache' => [
                'class' => '\yii\filters\HttpCache',
                'only' => ['http-cache'],
                'lastModified' => function($action, $params) {
                    $query = new \yii\db\Query();
                    return $query->from(User::tableName())->max('id');
                },
            ],
            'verbs' => [
                'class' => '\yii\filters\VerbFilter',
                'actions' => [
                    'post-only' => ['post'],
                ],
            ],
        ];
    }

    public function actionTest()
    {
        return 'Behavior/test';
    }

    public function actionHello()
    {
        return 'Hello world';
    }

    public function actionPageCache()
    {
        $n = mt_rand(0, 999);
        return 'Behavior/pageCache' . $n;
    }

    public function actionHttpCache()
    {
        $n = mt_rand(0, 999);
        return 'Behavior/httpCache' . $n;
    }

    public function actionPostOnly()
    {
        if(\Yii::$app->request->getIsPost()) {
            // POST访问需要csrf-token参数
            var_dump($_POST);
            exit;
        } else {
            return 'Behavior/post-only';
        }
    }

}