<?php
namespace frontend\controllers;

use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\UnauthorizedHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\ConflictHttpException;
use yii\web\GoneHttpException;
use yii\web\UnsupportedMediaTypeHttpException;
use yii\web\TooManyRequestsHttpException;
use yii\web\ServerErrorHttpException;

class ResponseController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    public function action400Error()
    {
        throw new BadRequestHttpException('Bad request http error');
    }

    public function action401Error()
    {
        throw new UnauthorizedHttpException('Unauthorized http error');
    }

    public function action403Error()
    {
        throw new ForbiddenHttpException('Forbidden http error');
    }

    public function action404Error()
    {
        throw new NotFoundHttpException('Page not found http error');
    }

    public function action405Error()
    {
        throw new MethodNotAllowedHttpException('Method not allowd http error');
    }

    public function action406Error()
    {
        throw new NotAcceptableHttpException('Not accept http error');
    }

    public function action409Error()
    {
        throw new ConflictHttpException('Conflict http error');
    }

    public function action410Error()
    {
        throw new GoneHttpException('Gone http error');
    }

    public function action415Error()
    {
        throw new UnsupportedMediaTypeHttpException('Unsupported media type http error');
    }

    public function action429Error()
    {
        throw new TooManyRequestsHttpException('Too many request error');
    }

    public function action500Error()
    {
        throw new ServerErrorHttpException('Server error');
    }

    public function actionContent()
    {
        return $this->_setResponseContent('Hello world 123');
    }

    private function _getResponse()
    {
        return \Yii::$app->response;
    }

    private function _setResponseContent($content)
    {
        return $this->_getResponse()->content = $content;
    }

    private function _setResponseData($data, $format = 'html')
    {
        if($format == 'html') {
            $html = $data;
            if(is_array($data)) {
                $html = 'Response Html: ' . json_encode($data);
            }
            return $this->_setResponseContent($html);
        }

        $response = $this->_getResponse();

        $response->format = Response::FORMAT_HTML;
        $response->data = $data;
        if($format == 'json') {
            $response->format = Response::FORMAT_JSON;
        } elseif($format == 'jsonp') {
            $response->format = Response::FORMAT_JSONP;
        } elseif($format == 'xml') {
            $response->format = Response::FORMAT_XML;
        } elseif($format == 'raw') {
            $response->format = Response::FORMAT_RAW;
            if(is_array($data)) {
                $response->data = 'Respone Raw: ' . json_encode($data);
            }
        }

        return $response;
    }

    private function _getData()
    {
        return [
            'username' => 'Jack',
            'age' => 22,
            'gender' => 'male'
        ];
    }

    public function actionXml()
    {
        return $this->_setResponseData($this->_getData(), 'xml');
    }

    public function actionJson()
    {
        return $this->_setResponseData($this->_getData(), 'json');
    }

    public function actionHtml()
    {
        return $this->_setResponseData($this->_getData());
    }

    public function actionJsonp()
    {
        return $this->_setResponseData($this->_getData(), 'jsonp');
    }

    public function actionRaw()
    {
        return $this->_setResponseData($this->_getData(), 'raw');
    }

}