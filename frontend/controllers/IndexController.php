<?php
namespace frontend\controllers;

class IndexController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    // 独立操作
    public function actions()
    {
        return [
            '404-error' => [
                'class' => 'frontend\controllers\NotFoundErrorAction',
                'message' => 'This page not found !'
            ],
        ];
    }

    /*
     * 控制器操作执行之前执行
     * */
    public function beforeAction($action)
    {
        if(!parent::beforeAction($action)) {
            return false;
        }

        // some code before dispatcher to action, it will be canceled if return false
        // TODO

        return true;
    }

    /*
     * 控制器操作执行完后, 渲染给客户端之前执行
     * */
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        // 对控制器返回结果统一进一步处理 ... TODO

        return $result;
    }

    public function actionIndex()
    {
        return 'Index/index';
    }

    public function actionJsonp()
    {
        $data = 'hello world';
        $callback = $_GET['callback'];
        return $callback . '(\''.$data.'\')';
    }

}