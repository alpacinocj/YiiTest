<?php
namespace frontend\controllers;

use common\models\News;
use yii\web\BadRequestHttpException;
use common\widgets\Alert;

class AssetsController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        return 'Assets/index';
    }

    public function actionTest()
    {
        if(\Yii::$app->request->getIsPost()) {
            var_dump($_POST);
            exit;
        }

        return $this->render($this->action->id);
    }

}