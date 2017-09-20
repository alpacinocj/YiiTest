<?php
namespace common\lib;

use common\lib\curl\Curl;
use common\lib\curl\MultiCurl;

class Helper
{

    /*
     * 检查手机号格式
     * @param string $phone 手机号码
     * @return boolean
     * */
    public static function isMobile($phone)
    {
        return preg_match("/^1[3456789]\d{9}$/", $phone);
    }

    /*
     * 检查邮箱地址格式
     * @param string $email;
     * @return boolean
     * */
    public static function isEmail($email)
    {
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        return preg_match($pattern, $email);
    }

    /*
     * 匹配A标签htef
     * @param string $urlTag A标签链接
     * @return array
     * */
    public static function pregMatchLinkHref($urlTag)
    {
        $pattern = "/<a([^>]*?)href=['\"]([^'\"]*?)['\"]([^>]*?)>(.*?)<\/a>/i";
        preg_match_all($pattern, $urlTag, $matches, PREG_SET_ORDER);
        return $matches;
    }

    /*
     * url安全的base64编码
     * @param string $data 待编码字符串
     * @return string
     * */
    public static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /*
     * url安全的base64解码
     * @param string $data 待解码字符串
     * @param string
     * */
    public static function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    /*
     * IP地址转无符号整数
     * @param string $ip IP地址
     * @return int
     * */
    public static function ip2UnsignedInt($ip)
    {
        list($a, $b, $c, $d) = preg_split("/\./", $ip);
        return (($a * 256 + $b) * 256 + $c) * 256 + $d;
    }

    /*
     * 无符号整数转IP地址
     * @param int $int 无符号整数
     * @return string
     * */
    public static function unsignedInt2Ip($int)
    {
        return long2ip($int);
    }

    /*
     * 是否中文字符
     * @param string $str 字符串
     * @return boolean
     * */
    public static function isChinese($str)
    {
        if (preg_match("/^[\\x{4e00}-\\x{9fa5}]+$/u", $str)) {
            return true;
        }
        return false;
    }

    /*
     * 获取当天开始时间戳
     * @return int
     * */
    public static function getDateBegin()
    {
        return mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    }

    /*
     * 获取当天结束时间戳
     * @return int
     * */
    public static function getDateEnd()
    {
        return mktime(23, 59, 59, date('m'), date('d'), date('Y'));
    }

    /*
     * 生成单号
     * @return int
     * */
    public static function createOrderNum()
    {
        return date('YmdHis', time()) . substr(floor(intval(microtime()) * 1000), 0, 1) . rand(0, 9);
    }

    /*
     * 基于swoole发送异步消息
     * @param array 消息模板参数
     * @return boolean or null
     * */
    public static function sendAsyncMessage($msgParams = [])
    {
        $res = false;
        $params = \Yii::$app->params;
        if(!isset($params['swoole_msg_api']) || empty($params['swoole_msg_api'])) {
            // do nothing
            return null;
        }

        try {
            // 异步请求
            $curl = new MultiCurl();
            $curl->addPost($params['swoole_msg_api'], $msgParams);
            $curl->start();
            $res = true;
        } catch (\Exception $e) {
            // 记录异常
            Logger::instance('exception')->error($e->getTraceAsString());
        }

        return $res;
    }

}