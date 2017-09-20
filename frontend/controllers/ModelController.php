<?php
namespace frontend\controllers;

use yii\web\BadRequestHttpException;
use common\models\News;
use common\response\ResponseJson;
use common\widgets\Alert;

/*
 * Test for model
 * */
class ModelController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    public function actionTest()
    {
        return 'model/test';
    }

    public function actionSave()
    {
        if(\Yii::$app->request->getIsPost()) {
            $data = \Yii::$app->request->post();
            $news = new News();
            $scenarios = $news->scenarios();
            $scenarioKeys = array_keys($scenarios);
            if(!in_array($data['scenario'], $scenarioKeys)) {
                throw new BadRequestHttpException('Bad request params');
            }
            $news->setScenario($data['scenario']);
            //$news->load(\Yii::$app->request->post());
            $news->attributes = $data;
            if($news->save()) {
                $id = $news->id;
                echo $id; exit;
            } else {
                $errors = $news->getFirstErrors();
                $error = current($errors);
                //exit($error);
                \Yii::$app->session->setFlash('error', $error);
                return Alert::widget();
            }
        } else {
            echo '<h3>模型场景测试</h3>';
            echo '<form name="" method="post" action="#">';
            echo '<label for="author">Author: <input type="text" name="author" id="author" value=""/></label><br/>';
            echo '<label for="title">Title: <input type="text" name="title" id="title" value=""/></label><br/>';
            echo '<label for="content">Content: <input type="text" name="content" id="content" value=""/></label><br/>';
            echo '<label><input type="radio" name="scenario" value="default" checked/>Default</label>';
            echo '<label><input type="radio" name="scenario" value="test"/>Test</label><br/>';
            echo '<input type="submit" value="Save"/>';
            echo '<input type="reset" value="Reset"/>';
            echo '<input type="hidden" name="'.\Yii::$app->request->csrfParam.'" value="'.\Yii::$app->request->getCsrfToken().'"/>';
            echo '</form>';
        }
    }

    public function actionUpdate()
    {

    }

    public function actionSelectOne()
    {
        if(!isset($_GET['id']) || empty($_GET['id'])) {
            throw new BadRequestHttpException('Missing param id');
        }
        $id = \Yii::$app->request->get('id');
        $item = News::findOne($id);
        if($item == null) {
            exit('Can not find anything');
        }
        // 返回结果转换成数组形式
        //var_dump($item->getAttributes()); // return array
        var_dump($item->toArray()); // return array, toArray()方法返回fields()方法重新定义的字段
        exit;
    }

    public function actionSelectAll()
    {
        $news = News::find();
        if(!$news->count()) {
            exit('Empty data');
        }
        // 查询结果转换成数组形式
        var_dump($news->asArray()->all());  // return array
        exit;
    }

    public function actionDataProvider()
    {
        $page = \Yii::$app->request->get('page', 1);
        $pageSize = \Yii::$app->request->get('pageSize', 10);

        if ($page < 1) {
            $page = 1;
        }

        $provider = News::fetchList([], --$page, $pageSize);

        $data = [];
        foreach ($provider->getModels() as $model) {
            $data['list'][] = $model->toArray();
        }
        $pagination = $provider->getPagination();
        $data['pagination'] = [
            'page' => $pagination->getPage() + 1,
            'pageSize' => $pagination->getPageSize(),
            'pageCount' => $pagination->getPageCount(),
            'totalCount' => $provider->getTotalCount()
        ];

        ResponseJson::i()->sendSuccess($data);

    }

    public function actionDelete()
    {

    }

    public function actionSaveMultiple()
    {

    }

    public function actionUpdateMultiple()
    {

    }
}