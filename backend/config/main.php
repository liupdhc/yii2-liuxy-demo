<?php

return [
    'basePath' => dirname(__DIR__),
    'defaultRoute' => '/site/default/index',
    'modules' => [
        'admin' => [
            'class' => 'liuxy\admin\Module'
        ],
        'description' => [
            'class' => 'modules\description\Module',
            'isBackend'=>true
        ],
        'site' => [
            'isBackend'=>true
        ]
    ],
    'components' => [
        'i18n' => [
            'suffix'=>'backend'
        ],
        'request' => [
            'enableCookieValidation' => false,
            'baseUrl' => '/backend'
        ],
        'view' => [
            'theme' => 'liuxy\admin\Theme'
        ],
        'errorHandler' => [
            'errorAction' => 'admin/default/error'
        ]
    ],
    'params' => require(__DIR__ . '/params.php')
];
