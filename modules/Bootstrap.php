<?php
/**
 * FileName: Bootstrap.php.
 * Author: liupeng
 * Date: 2015/8/2
 */

namespace modules;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;

/**
 * Class Bootstrap
 * @package modules
 */
class Bootstrap implements BootstrapInterface {


    /**
     * @var string|null Module name
     */
    public static $name = 'common';

    /**
     * @var string Module author
     */
    public static $author = '';

    public function bootstrap($app) {
        if (static::$name === null) {
            throw new InvalidConfigException('The "name" property must be set.');
        }
    }
}