<?php

namespace modules\components\assets\frontend;

use liuxy\admin\assets\AbstractAsset;
use Yii;

/**
 * FileName: BaseScriptAsset.php.
 * Author: liupeng
 * Date: 2015/8/3
 */
class BaseScriptAsset extends AbstractAsset {

    protected $plugin_js = [
        'jquery.themepunch.revolution.min.js',
        'jquery.themepunch.tools.min.js',
        'plugins.min.js'
    ];

    /**
     * @inheritdoc
     */
    protected $plugin_depends = [
        'liuxy\frontend\assets\BaseAsset'
    ];

    public function init()
    {
        $this->sourcePath = '@webroot/static/scripts/';
        parent::init();
    }
}