<?php
namespace common\response;

class Response extends BaseResponse implements ResponseInterface
{
    protected $responseFormatter;
    protected $type;

    public function __construct(ResponseFormatterInterface $responseFormatter, $type = 'json')
    {
        $this->responseFormatter = $responseFormatter;
        $this->type = $type;
    }

    public function sendSuccess($data)
    {
        $responseData = $this->responseFormatter->success($data);
        return parent::send($responseData, $this->type, 200);
    }

    public function sendError($error)
    {
        // 错误码的处理
        $code = 0;
        $params = \Yii::$app->params;
        if(isset($params['error_code'])) {
            $params = array_flip($params['error_code']);
            if(isset($params[$error])) {
                $code = (int) $params[$error];
                $error = \Yii::t('error', $error);
            }
        }
        $responseData = $this->responseFormatter->error($error, $code);
        return parent::send($responseData, $this->type, 500);
    }

    public function sendException(\Exception $e)
    {
        $error = $e->getTraceAsString();
        $code = $e->getCode();
        $responseData = $this->responseFormatter->error($error, $code);
        return parent::send($responseData, $this->type, 400);
    }

}