<?php
/**
 * FileName:cache.dev.php
 * Author:liupeng
 * Create Date:2015-09-16
 */

return [
    'fileCache'=>[
        'class'=>'\yii\caching\FileCache',
        'keyPrefix'=>'common.file.',
        'serializer'=>[
            'igbinary_serialize','igbinary_unserialize'
        ]
    ],
    'cache' => [
        'class' => '\yii\liuxy\MemCache',
        'keyPrefix' => 'common.',
        'serializer'=>[
            'igbinary_serialize','igbinary_unserialize'
        ],
        'servers' => [
            [
                'host' => '127.0.0.1',
                'port' => 11211,
                'weight' => 1
            ]
        ]
    ]
];