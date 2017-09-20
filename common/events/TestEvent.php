<?php
namespace common\events;

use yii\base\Event;
use yii\base\Component;

/*
 * http://blog.csdn.net/u012979009/article/details/51496165
 * */
class TestEvent extends Component
{
    const SAY_EVENT = 'say';

    public function say(Event $event)
    {
        // 这里可以分离一些复杂的业务逻辑单独处理 ...
        // get data from event object
        print_r($event->data);
    }
}