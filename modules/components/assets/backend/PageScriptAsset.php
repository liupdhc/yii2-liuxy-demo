<?php

namespace modules\components\assets\backend;

use liuxy\admin\assets\AbstractAsset;
use Yii;

/**
 * FileName: BaseScriptAsset.php.
 * Author: liupeng
 * Date: 2015/8/3
 */
class PageScriptAsset extends AbstractAsset {

    /**
     * 注册单个JS至页面
     * @param $view \yii\web\View
     * @param $js   string
     */
    public static function registerJsFile($view, $js) {
        if (is_array($js)) {
            foreach($js as $item) {
                $file = Yii::getAlias('@webroot/static').'/scripts/pages/'.$js.'.js';
                if (file_exists($file)) {
                    $view->registerJsFile(Yii::getAlias('@web/static').'/scripts/pages/'.$item.'.js?'.static::hash($file),
                        ['depends'=>['liuxy\admin\assets\ThemeAsset']]);
                }
                unset($file);
            }
        } else {
            $file = Yii::getAlias('@webroot/static').'/scripts/pages/'.$js.'.js';
            if (file_exists($file)) {
                $view->registerJsFile(Yii::getAlias('@web/static').'/scripts/pages/'.$js.'.js?'.static::hash($file),
                    ['depends'=>['liuxy\admin\assets\ThemeAsset']]);
            }
            unset($file);
        }
    }
}