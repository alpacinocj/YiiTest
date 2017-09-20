<?php
namespace frontend\controllers;

use common\components\TestBehavior;

class BehaviorBindController extends BaseController
{
    public function actionTest()
    {
        return 'behavior-bind/test';
    }

    /*
     * 测试行为绑定功能
     * */
    public function actionTestBindBehaviors()
    {
        // 实例化行为类
        $testBehavior = new TestBehavior();
        // 动态绑定行为类(继承自yii\base\Component)
        $this->attachBehavior('testBehavior', $testBehavior);
        // 绑定后本类就具有了该行为类的属性和方法
        // 调用行为类中的属性和方法
        //echo $this->name;
        echo $this->age;
        echo '<br/>';
        echo $this->say();
        //echo $this->talk();
        exit;
    }
}