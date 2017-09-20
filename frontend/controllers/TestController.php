<?php
namespace frontend\controllers;

use common\events\TestEvent;
use yii\web\NotFoundHttpException;
use common\services\ChatService;

class TestController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        echo 'Test/index' . '<br/>';
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            echo $_GET['id'];
        }
        exit;
    }

    public function actionTest()
    {
        $chat = new ChatService();
        var_dump($chat);
        die;
        return 'Test/test';
    }

    public function actionEvent()
    {
        // 一些业务逻辑处理完成之后, 如登录成功之后的处理 ...

        // 测试事件绑定
        $testEvent = new TestEvent();

        $testEvent->on($testEvent::SAY_EVENT, [$testEvent, 'say'], 'hello world');

        $testEvent->trigger($testEvent::SAY_EVENT);

        exit;
    }

    public function actionNotFound()
    {
        throw new NotFoundHttpException('Can not found your page!');
    }

}