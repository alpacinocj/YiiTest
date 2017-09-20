<?php
namespace common\events;

use yii\base\Event;
use yii\base\Component;

class UserEvent extends Component
{
    const SIGNUP_SUCCESS_EVENT = 'signupSuccess';

    public function onSignupSuccess(Event $event)
    {
        // 用户注册成功之后发送短息 ...

        $user = $event->data;       // 传过来的user对象
        if(!is_object($user)) {
            return;
        }

        echo "尊敬的{$user->username}, 恭喜您注册成功!";
    }
}