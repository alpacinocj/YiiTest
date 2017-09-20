<?php
namespace common\response;

use yii\web\Response as YiiWebResponse;
use common\lib\Logger;

class BaseResponse
{
    public function send($data, $type = 'json', $statusCode = 200)
    {
        $request = \Yii::$app->getRequest();
        $response = \Yii::$app->getResponse();
        $url = $request->getUrl();
        if(strpos($url, '/sample') === 0) {
            $response->headers->set('Access-Control-Allow-Origin', '*');
        }
        $type = strtoupper($type);
        if($type == 'JSON') {
            $response->format = YiiWebResponse::FORMAT_JSON;
        } elseif($type == 'XML') {
            $response->format = YiiWebResponse::FORMAT_XML;
        } else {
            $response->format = YiiWebResponse::FORMAT_HTML;
        }
        $response->statusCode = $statusCode;
        $response->data = $data;
        return $response->send();
    }
}