<?php
$environment = (getenv('APP_ENV') != '' ? getenv('APP_ENV') : 'test');
defined('YII_ENV') or define('YII_ENV', $environment);
defined('YII_DEBUG') or define('YII_DEBUG', (YII_ENV == 'test'));

define('WEB_ROOT', realpath(__DIR__ . '/') . DIRECTORY_SEPARATOR);
/**
 * @var $classLoader \Composer\Autoload\ClassLoader
 */
$classLoader = require('autoload.php');
$classLoader->setPsr4( 'modules\\', array(WEB_ROOT . '/../../modules'));

require('yiisoft/yii2/Yii.php');
define('VENDOR_PATH', YII2_PATH . '/../../');

require(__DIR__ . '/../../common/config/aliases.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../config/main.php')
);
$config = \yii\helpers\ArrayHelper::merge($config,
    ['components'=>[
        'assetManager' => [
            'linkAssets' => false,
        ]
    ]]);

$application = new yii\web\Application($config);
$application->run();