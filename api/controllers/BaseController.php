<?php
namespace api\controllers;

use yii\web\Controller;
use common\lib\Logger;

class BaseController extends Controller
{
    public function init()
    {
        return parent::init();
    }

    public function beforeAction($action)
    {
        if(parent::beforeAction($action)) {
            Logger::instance('route')->debug($action->id);
            return true;
        }
        return false;
    }

}