<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 2015/12/26
 * Time: 20:28
 */

namespace modules\components\assets\frontend;

use Yii;
use liuxy\frontend\assets\AbstractAsset;

/**
 * Class PageScriptAsset
 * @package modules\components\assets\frontend
 */
class PageScriptAsset extends AbstractAsset
{
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
                        ['depends'=>['modules\components\assets\frontend\BaseScriptAsset']]);
                }
                unset($file);
            }
        } else {
            $file = Yii::getAlias('@webroot/static').'/scripts/pages/'.$js.'.js';
            if (file_exists($file)) {
                $view->registerJsFile(Yii::getAlias('@web/static').'/scripts/pages/'.$js.'.js?'.static::hash($file),
                    ['depends'=>['modules\components\assets\frontend\BaseScriptAsset']]);
            }
            unset($file);
        }
    }
}