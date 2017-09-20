<?php
namespace frontend\controllers;

use common\models\News;

class LogController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        return 'Log/index';
    }

    public function actionTrace()
    {
        \Yii::trace('This is a trace log');
        return 1;
    }

    public function actionInfo()
    {
        \Yii::info('This is an info log');
        return 1;
    }

    public function actionWarning()
    {
        \Yii::warning('This is a warning log');
        return 1;
    }

    public function actionError()
    {
        \Yii::error('This is an error log');
        return 1;
    }

    public function actionProfile()
    {
        \Yii::beginProfile('fetch_all_news');
        $news = News::find();
        if(!$news->count()) {
            exit('Can not find anything');
        }
        \Yii::endProfile('fetch_all_news');
        var_dump($news->asArray()->all());
        exit;
    }

    public function actionTest()
    {
        try {
            9 / 0;
        } catch (\Exception $e) {
            \Yii::error($e->getTraceAsString());
            return $e->getMessage();
        }
        return 1;
    }

}