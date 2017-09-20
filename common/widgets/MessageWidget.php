<?php
namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class MessageWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if($this->message == null) {
            $this->setMessage('Hello world');
        }
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function run()
    {
        return Html::encode($this->message);
    }

}