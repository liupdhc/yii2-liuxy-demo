<?php

$config = [
    'id' => 'yii2-demo',
    'name' => 'yii2-demo',
    'vendorPath' => VENDOR_PATH,
    'timeZone' => 'Asia/Shanghai',
    'runtimePath' => WEB_ROOT . '../runtime',
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
    'modules' => [
        'site' => [
            'class' => 'modules\site\Module'
        ]
    ],
    'components' => [
        'i18n' => [
            'class'=>'modules\components\i18n\I18N'
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>',
                '<_m>/<_c>/<_a>.json' => '<_m>/<_c>/<_a>',
                '<_m>/<_ver>/<_c>/<_a>.json' => '<_m>/<_ver>/<_c>/<_a>'
            ]
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning',
                        'trace',
                        'info'
                    ],
                    'logFile' => '@runtime/logs/' . date('Ymd') . '.log',
                    'maxFileSize' => 10240
                ]
            ]
        ]
    ],
    'params' => require(__DIR__ . '/params.php')
];
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config ['bootstrap'] [] = 'debug';
    $config ['modules'] ['debug'] = [
        'class'=>'yii\debug\Module',
        'allowedIPs'=>['127.0.0.1', '::1','192.168.*']
    ];

    $config ['bootstrap'] [] = 'gii';
    $config ['modules'] ['gii'] = [
        'class'=>'yii\gii\Module',
        'allowedIPs'=>['127.0.0.1', '::1','192.168.*']
    ];
}

$config ['components'] = yii\helpers\ArrayHelper::merge($config ['components'], require __DIR__ . '/env/db.'.YII_ENV.'.php');
$config ['components'] = yii\helpers\ArrayHelper::merge($config ['components'], require __DIR__ . '/env/cache.'.YII_ENV.'.php');

return $config;
