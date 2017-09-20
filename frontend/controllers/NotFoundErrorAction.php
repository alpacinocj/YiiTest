<?php
namespace frontend\controllers;

use yii\base\Action;
use yii\web\NotFoundHttpException;

class NotFoundErrorAction extends Action
{
    public $message = null;

    public function run()
    {
        throw new NotFoundHttpException($this->message);
    }
}