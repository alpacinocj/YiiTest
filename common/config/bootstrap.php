<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@frontend_logs', dirname(dirname(__DIR__)) . '/frontend/runtime/logs');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@backend_logs', dirname(dirname(__DIR__)) . '/backend/runtime/logs');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@console_logs', dirname(dirname(__DIR__)) . '/console/runtime/logs');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@api_logs', dirname(dirname(__DIR__)) . '/api/runtime/logs');
