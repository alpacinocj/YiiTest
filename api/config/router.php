<?php

function parse_domain($url)
{
    $domain = '';
    $domain_postfix_cn_array = array("com", "net", "org", "gov", "edu", "com.cn", "cn","me");
    $array_domain = explode(".", $url);
    $array_num = count($array_domain) - 1;
    if ($array_domain[$array_num] == 'cn')
    {
        if (in_array($array_domain[$array_num - 1], $domain_postfix_cn_array))
        {
            $domain = $array_domain[$array_num - 2] . "." . $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        }
        else
        {
            $domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        }
    }
    else
    {
        $domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
    }
    return $domain;
}

$domain = parse_domain($_SERVER['HTTP_HOST']);

define('DOMAIN', $domain);

// 路由规则
return [
    '' => 'index/index',
    '/index' => 'index/index',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    '/sample/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
];