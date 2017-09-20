<?php
namespace api\controllers;

use common\response\ResponseJson;

class UserController extends BaseController
{

    /**
     * @apiDefine ParamsErrorExample
     * @apiErrorExample Params Error
     *     HTTP/1.1 500 params error
     *     {
     *        "error": 1,
     *        "code": 10003,
     *        "msg": "参数格式非法"
     *     }
     */

    /**
     * @apiDefine ErrorResponseParams
     * @apiError {Number} code 错误码
     * @apiError {String} msg 错误提示
     */

    /**
     * @api {get} /user/info 获取用户
     * @apiVersion 1.0.0
     * @apiName GetUser
     * @apiGroup UserGroup
     *
     * @apiDescription 获取用户个人信息
     *
     * @apiParam {Number} id 用户ID
     *
     * @apiSuccess {Number} id 用户ID
     * @apiSuccess {String} name 用户昵称
     * @apiSuccess {Number} age 用户年龄
     * @apiSuccessExample Success Response
     *     HTTP/1.1 200 OK
     *     {
     *         "error": 0,
     *         "data": {
     *             "id": "1",
     *             "name": "tom",
     *             "age": 22
     *         }
     *     }
     * @apiUse ErrorResponseParams
     * @apiErrorExample Error Response
     *     HTTP/1.1 500 Some Error
     *     {
     *         "error": 1,
     *         "code": 20001,
     *         "msg": "此用户不存在"
     *     }
     * @apiUse ParamsErrorExample
     */
    public function actionInfo($id)
    {
        if ($id <= 0) {
            return ResponseJson::i()->sendError('USER_NOT_EXISTS');
        }
        $user = [
            'id' => $id,
            'name' => 'tom',
            'age' => 22
        ];
        return ResponseJson::i()->sendSuccess($user);
    }

    /**
     * @api {post} /user/login 用户登录
     * @apiVersion 1.0.0
     * @apiName UserLogin
     * @apiGroup UserGroup
     *
     * @apiDescription 用户登录
     *
     * @apiParam {Number{11}} mobile 手机号
     * @apiParam {String{6..18}} password 密码
     *
     * @apiSuccessExample Success Response
     *     HTTP/1.1 200 OK
     *     {
     *       "error": 0,
     *       "data": true
     *     }
     *
     * @apiUse ErrorResponseParams
     * @apiErrorExample Error Response
     *     HTTP/1.1 500 Some Error
     *     {
     *       "error": 1,
     *       "code": 10001,
     *       "msg": "some error",
     *     }
     * @apiUse ParamsErrorExample
     */
    public function actionLogin()
    {
        $params = \Yii::$app->request->post();
        if(0) {
            return ResponseJson::i()->sendSuccess(true);
        } else {
            return ResponseJson::i()->sendError('USER_LOGIN_FAIL');
        }
    }

}