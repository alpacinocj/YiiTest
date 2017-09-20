<?php
namespace common\components;

use yii\base\Behavior;

class TestBehavior extends Behavior
{
    public $name = 'Jack';
    private $age = 18;

    public function say()
    {
        return 'Hello world';
    }

    private function talk()
    {
        return 'Hi, how are you';
    }

    public function getAge()
    {
        return $this->age;
    }
}