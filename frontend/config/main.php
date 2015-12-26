<?php

return [
    'basePath' => dirname(__DIR__),
    'defaultRoute' => '/site/default/index',
    'modules' => [
        'frontend'=>[
            'class' => 'liuxy\frontend\Module'
        ]
    ],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'baseUrl' => '/'
        ],
        'view' => [
            'theme' => 'liuxy\frontend\Theme'
        ]
    ],
    'params' => require(__DIR__ . '/params.php')
];
