<?php
/**
 * FileName: ApiErrorAction.php
 * Author: liupeng
 * Date: 12/22/15
 */

namespace modules\components\actions;


use yii\base\Action;

/**
 * 错误处理
 * Class ApiErrorAction
 * @package modules\components\actions
 */
class ApiErrorAction extends Action {

    /**
     * Runs the action
     *
     * @return string result content
     */
    public function run()
    {
        return \Yii::$app->getErrorHandler()->exception;
    }
}