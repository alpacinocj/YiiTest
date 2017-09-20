<?php
namespace common\response;

interface ResponseInterface
{
    public function sendSuccess($data);

    public function sendError($error);

    public function sendException(\Exception $e);
}