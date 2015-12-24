<?php
/**
 * FileName: DefaultController.php.
 * Author: liupeng
 * Date: 2015/8/3
 */

namespace modules\description\controllers\backend;

use modules\components\controllers\BackendController;
use modules\description\Module;

/**
 * 模块描述
 * Class DefaultController
 * @package modules\description\backend\controllers\backend
 */
class DefaultController extends BackendController {

    /**
     * 首页
     */
    public function actionHome() {
        $this->setResponseData(['breads'=>[
            ['name'=>Module::t( 'home.title')]
        ]]);
    }

    /**
     * 系统设置
     */
    public function actionSetting() {
        $this->setResponseData(['breads'=>[
            ['name'=>Module::t( 'setting.title')]
        ]]);
    }
}