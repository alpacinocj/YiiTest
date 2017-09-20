<?php
namespace api\controllers;

use common\response\ResponseJson;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        // some code ...
        return ResponseJson::instance()->sendSuccess('index page');
    }

    public function actionError()
    {
        // some code ...
        return ResponseJson::i()->sendError('ORDER_NOT_EXISTS');
    }

    public function actionException()
    {
        try {
            // some code ...
            $a = 1 / 0;
            return ResponseJson::i()->sendSuccess($a);
        } catch (\Exception $e) {
            return ResponseJson::i()->sendException($e);
        }
    }
}