<?php
namespace console\controllers;

use yii\console\Controller;

class TestController extends Controller
{

    // yii test/index
    public function actionIndex()
    {
        echo 'console/test/index';
    }

    // yii test/add 9 8
    public function actionAdd($a, $b)
    {
        if(!is_numeric($a) || !is_numeric($b)) {
            echo 'Wrong params';
            return 1;
        }
        echo $a . '+' . $b . '=' . ($a + $b);
        return 0;
    }

}