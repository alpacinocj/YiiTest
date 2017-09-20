<?php
namespace api\controllers;

use common\response\ResponseJson;

class ErrorController extends BaseController
{

    public function actionHandle()
    {
        $exception = \Yii::$app->errorHandler->exception;
        $error = $exception->getMessage();
        return ResponseJson::i()->sendError($error);
    }

}