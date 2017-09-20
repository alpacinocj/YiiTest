<?php
namespace frontend\controllers;

use common\models\User;
use common\widgets\MessageWidget;

class WidgetsController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $user = User::findOne(6);
        $data = [
            'model' => $user
        ];
        return $this->render('index', $data);
    }

    public function actionCustom()
    {
        if(isset($_GET['message']) || !empty($_GET['message'])) {
            $message = \Yii::$app->request->get('message');
            return MessageWidget::widget(['message' => $message]);
        }
        return MessageWidget::widget();
    }

}
