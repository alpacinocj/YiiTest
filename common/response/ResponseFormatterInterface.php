<?php
namespace common\response;

interface ResponseFormatterInterface
{
    public function success($data);

    public function error($error, $code = 0);
}