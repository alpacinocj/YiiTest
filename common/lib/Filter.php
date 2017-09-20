<?php
namespace common\lib;

class Filter
{
    /**
     * 安全过滤类-过滤javascript,css,iframes,object等不安全参数 过滤级别高
     * @param  string $value 需要过滤的值
     * @return string
     */
    public static function fliter_script($value) {
        $value = preg_replace_callback("/(javascript:)?on(click|load|key|mouse|error|abort|move|unload|change|dblclick|move|reset|resize|submit)/i",function() { return "&111n\\2"; },$value);
        $value = preg_replace_callback("/(.*?)<\/script>/si",function() { return ""; },$value);
        $value = preg_replace_callback("/(.*?)<\/iframe>/si",function() { return ""; },$value);
        //$value = preg_replace_callback ("//iesU", function() { return ""; }, $value);
        return $value;
    }

    /**
     * 安全过滤类-过滤HTML标签
     * @param  string $value 需要过滤的值
     * @return string
     */
    public static function fliter_html($value) {
        if (function_exists('htmlspecialchars'))
            return htmlspecialchars($value);
        return str_replace(array("&", '"', "'", "<", ">"), array("&", "\"", "'", "<", ">"), $value);
    }

    /**
     * 安全过滤类-对进入的数据加下划线 防止SQL注入
     * @param  string $value 需要过滤的值
     * @return string
     */
    public static function fliter_sql($value) {
        $sql = array("select", 'insert', "update", "delete", "\'", "\/\*",
            "\.\.\/", "\.\/", "union", "into", "load_file", "outfile");
        $sql_re = array("","","","","","","","","","","","");
        return str_replace($sql, $sql_re, $value);
    }

    /**
     * 安全过滤类-通用数据过滤
     * @param string $value 需要过滤的变量
     * @return string|array
     */
    public static function fliter_escape($value) {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = self::fliter_str($v);
            }
        } else {
            $value = self::fliter_str($value);
        }
        return $value;
    }

    /**
     * 安全过滤类-字符串过滤 过滤特殊有危害字符
     * @param  string $value 需要过滤的值
     * @return string
     */
    public static function fliter_str($value) {
        $badstr = array("\0", "%00", "\r", '&', ' ', '"', "'", "<", ">", "   ", "%3C", "%3E");
        $newstr = array('', '', '', '&', ' ', '"', '\'', "<", ">", "   ", "<", ">");
        $value  = str_replace($badstr, $newstr, $value);
        $value  = preg_replace_callback('/&((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $value);
        return $value;
    }

    /**
     * 私有路劲安全转化
     * @param string $fileName
     * @return string
     */
    public static function filter_dir($fileName) {
        $tmpname = strtolower($fileName);
        $temp = array(':/',"\0", "..");
        if (str_replace($temp, '', $tmpname) !== $tmpname) {
            return false;
        }
        return $fileName;
    }

    /**
     * 过滤目录
     * @param string $path
     * @return array
     */
    public function filter_path($path) {
        $path = str_replace(array("'",'#','=','`','$','%','&',';'), '', $path);
        return rtrim(preg_replace('/(\/){2,}|(\\\){1,}/', '/', $path), '/');
    }

    /**
     * 过滤PHP标签
     * @param string $string
     * @return string
     */
    public function filter_phptag($string) {
        return str_replace(array(''), array('<?', '?>'), $string);
    }

    /**
     * 安全过滤类-返回函数
     * @param  string $value 需要过滤的值
     * @return string
     */
    public function str_out($value) {
        $badstr = array("<", ">", "%3C", "%3E");
        $newstr = array("<", ">", "<", ">");
        $value  = str_replace($newstr, $badstr, $value);
        return stripslashes($value); //下划线
    }
}