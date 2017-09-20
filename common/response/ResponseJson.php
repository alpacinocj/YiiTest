<?php
namespace common\response;

class ResponseJson
{
    public static function instance()
    {
        if(!\Yii::$container->hasSingleton(__CLASS__)) {
            \Yii::$container->setSingleton(__CLASS__, 'common\response\Response', [new ResponseFormatter(), 'json']);
        }
        return \Yii::$container->get(__CLASS__);
    }

    public static function i()
    {
        return self::instance();
    }
}