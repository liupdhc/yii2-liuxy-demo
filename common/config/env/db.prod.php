<?php

$masterConfig = [
    'class' => 'yii\db\Connection',
    'charset' => 'utf8mb4',
    'enableSchemaCache' => true
];
$verifyInfo = ['username' => 'root', 'password' => 'root'];

return [
    'db' => \yii\liuxy\helpers\ArrayHelper::merge($masterConfig,[
        'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=yii2_demo'
    ], $verifyInfo)
];