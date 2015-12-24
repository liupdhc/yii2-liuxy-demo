<?php

namespace modules\components\assets;

use liuxy\admin\assets\AbstractAsset;
use Yii;

/**
 * FileName: BackendAssetBundle.php.
 * Author: liupeng
 * Date: 2015/8/3
 */
class BackendAssetBundle extends AbstractAsset {

    /**
     * 注册单个JS至页面
     * @param $view \yii\web\View
     * @param $js   string
     */
    public static function registerJsFile($view, $js) {
        if (is_array($js)) {
            foreach($js as $item) {
                if (YII_ENV == 'prod') {
                    $item.='.min';
                }
                $view->registerJsFile(Yii::getAlias('@web/static').'/scripts/pages/'.$item.'.js',
                    ['depends'=>['liuxy\admin\assets\ThemeAsset']]);
            }
        } else {
            if (YII_ENV == 'prod') {
                $js.='.min';
            }
            $view->registerJsFile(Yii::getAlias('@web/static').'/scripts/pages/'.$js.'.js',
                ['depends'=>['liuxy\admin\assets\ThemeAsset']]);
        }
    }
}