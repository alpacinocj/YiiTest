<?php
namespace common\lib;

class Connection extends \yii\db\Connection
{

    public function createCommand($sql = null, $params = [])
    {
        $createCommand = parent::createCommand($sql, $params);
        $rawSql = $createCommand->getRawSql();
        // log raw sql except production environment
        if(!YII_ENV_PROD) {
            // SQL日志 过滤访问元数据SQL
            if($rawSql && strpos($rawSql, 'information_schema') === false) {
                Logger::instance('db')->info($rawSql);
            }
        }
        return $createCommand;
    }

}