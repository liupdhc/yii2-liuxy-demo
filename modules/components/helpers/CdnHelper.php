<?php
/**
 * FileName: CdnHelper.php
 * Author: liupeng
 * Date: 10/9/15
 */

namespace modules\components\helpers;

/**
 * CDN帮助类
 * Class CdnHelper
 * @package modules\components\helpers
 */
class CdnHelper {

    /**
     * 根据模块获取对应的CDN域名
     * @param $module
     */
    public static function getDomain($module) {
        $cdnParams = \Yii::$app->params['cdn'];

        if (isset($cdnParams[$module])) {
            $node = NodeBalanceHelper::getByWeight($cdnParams[$module]);
            return $node['domain'];
        } else if (isset($cdnParams['default'])) {
            $node = NodeBalanceHelper::getByWeight($cdnParams['default']);
            return $node['domain'];
        }
        return '';
    }
}