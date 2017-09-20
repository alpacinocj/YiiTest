<?php
namespace common\models;

use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    public function init()
    {
        parent::init();
    }

    public static function getDb()
    {
        return \Yii::$app->getDb();
    }

    public static function getLastInsertId()
    {
        return self::getDb()->getLastInsertID();
    }

    public static function createCommand($sql = null)
    {
        if($sql !== null) {
            return self::getDb()->createCommand($sql);
        }
        return self::getDb()->createCommand();
    }

    public static function executeSql($sql)
    {
        return self::createCommand($sql)->execute();
    }

    public static function queryOneBySql($sql, $bindValues = [])
    {
        if(!empty($bindValues) && is_array($bindValues)) {
            return self::createCommand($sql)->bindValues($bindValues)->queryOne();
        }
        return self::createCommand($sql)->queryOne();
    }

    public static function queryAllBySql($sql, $bindValues = [])
    {
        if(!empty($bindValues) && is_array($bindValues)) {
            return self::createCommand($sql)->bindValues($bindValues)->queryAll();
        }
        return self::createCommand($sql)->queryAll();
    }

}