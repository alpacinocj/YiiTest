<?php
/*
 * 全局错误码配置表
 * 参考新浪微博接口错误码: http://open.weibo.com/wiki/Error_code
 * 错误代码说明:
 * 共5位数字组成
 * 第1位代表错误级别(1系统级别, 2服务级别)
 * 第2,3位代表服务模块代码
 * 第4,5位代表具体错误代码
 * */
return [
    'error_code' => [
        // 系统级别
        10001 => 'SYSTEM_ERROR',
        10002 => 'MISSING_REQUIRED_PARAMETER',
        10003 => 'INVALID_PARAMS',

        // 服务级别 (用户模块200xx)
        20001 => 'USER_NOT_EXISTS',
        20002 => 'USER_LOGIN_FAIL',

        // 服务级别 (订单模块201xx)
        20101 => 'ORDER_NOT_EXISTS',

        // 服务级别 (公共模块202xx)
        20201 => 'TOKEN_EXPIRED',
    ]
];