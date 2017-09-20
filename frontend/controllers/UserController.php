<?php
namespace frontend\controllers;

use common\models\User;
use common\events\UserEvent;

class UserController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionLogout()
    {
        return $this->render('logout');
    }

    /*
     * 测试绑定事件, 触发事件
     * 绑定事件用法示例 :
     * 1. 使用PHP全局函数作为handler绑定
     * $object->on(ClassName::EVENT_NAME, 'php_function_name');
     * 2. 使用对象成员函数作为handler绑定
     * $object->on(ClassName::EVENT_NAME, [$obj, 'obj_function_name']);
     * 3. 使用类的静态函数作为handler绑定
     * $object->on('namespace\ClassName', 'static_function_name');
     * 4. 使用匿名函数作为handler绑定
     * $object->on(ClassName::EVENT_NAME, function($event){
     *      // some code to do something ...
     * });
     *
     * 如果绑定事件的同时需要传递参数, 则可以使用yii\base\Component::on()的第三个参数, 该参数将会写入Event的data属性
     * $object->on(ClassName::EVENT_NAME, [$obj, 'obj_function_name'], 'Hello world');
     * 在handler函数中获取该参数
     * function obj_function_name($event)
     * {
     *      $data = $event->data;       // Hello world
     * }
     * */
    public function actionSignup()
    {
        if(\Yii::$app->getRequest()->getIsPost()) {
            //var_dump($_POST); exit;
            $user = new User();
            $user->username = \Yii::$app->getRequest()->post('username');
            $user->email = \Yii::$app->getRequest()->post('email');
            $user->setPassword(\Yii::$app->getRequest()->post('password'));
            $user->generateAuthKey();
            $user->generatePasswordResetToken();
            if($user->save()) {
                $userEvent = new UserEvent();
                // 绑定事件(可以同一事件绑定多个handler)
                $userEvent->on($userEvent::SIGNUP_SUCCESS_EVENT, [$userEvent, 'onSignupSuccess'], $user);
                // 触发事件
                $userEvent->trigger($userEvent::SIGNUP_SUCCESS_EVENT);
            } else {
                $errors = $user->getFirstErrors();
                $error = (!empty($errors)) ? current($errors) : '注册失败';
                exit($error);
            }
        } else {
            echo '<form name="signupForm" method="post" action="#">';
            echo '<label for="username">Username: <input type="text" id="username" name="username" value=""/></label><br/>';
            echo '<label for="email">Email: <input type="text" id="email" name="email" value=""/></label><br/>';
            echo '<label for="">Password: <input type="password" id="password" name="password" value=""/></label><br/>';
            echo '<input type="hidden" name="'.\Yii::$app->request->csrfParam.'" value="'.\Yii::$app->request->getCsrfToken().'"/>';
            echo '<input type="submit" value="Send"/>';
            echo '<input type="reset" value="Reset"/>';
            echo '</form>';
        }
    }

}
