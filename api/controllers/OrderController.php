<?php
namespace api\controllers;

use common\response\ResponseJson;

class OrderController extends BaseController
{

    /**
     * @api {get} /order/info 获取订单信息
     * @apiVersion 1.0.0
     * @apiName GetOrder
     * @apiGroup OrderGroup
     *
     * @apiDescription 获取订单信息
     *
     * @apiParam {Number} id 订单ID
     *
     * @apiSuccess {Boolean} data 成功
     * @apiSuccessExample Success Response
     *     HTTP/1.1 200 OK
     *     {
     *       "error": 0,
     *       "data": true
     *     }
     *
     * @apiError {Number} code Error Code
     * @apiError {String} msg Error Msg
     * @apiErrorExample Error Response
     *     HTTP/1.1 500 Some Error
     *     {
     *       "error": 1,
     *       "code": 10001,
     *       "msg": "some error",
     *     }
     * @apiUse ParamsErrorExample
     */
    public function actionInfo($id)
    {
        if($id <= 0) {
            return ResponseJson::i()->sendError('ORDER_NOT_EXISTS');
        }
        return ResponseJson::i()->sendSuccess(true);
    }

}