<?php
/**
 * 前台主题管理
 * FileName: Theme.php.
 * Author: liupeng
 * Date: 2015/8/15
 */
namespace modules\site\themes\frontend;

class Theme extends \yii\base\Theme  {
    /**
     * @inheritdoc
     */
    public $pathMap = [
        '@frontend/views' => '@modules/views/frontend',
    ];

    public $template = 'default';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

    }
}