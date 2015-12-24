<?php

namespace modules;

use Yii;
use yii\base\InvalidConfigException;

/**
 * 全局配置模块.
 * Class Module
 * @package modules
 */
abstract class Module extends \yii\base\Module {

    /**
     * @var boolean Whether module is used for backend or not
     */
    public $isBackend = false;

    /**
     * 是否来自客户端请求
     * @var bool
     */
    public $isApi = false;

    /**
     * 是否来自控制台
     * @var bool
     */
    public $isConsole  = false;

    /**
     * @var string|null Module name
     */
    public static $name;

    /**
     * @var string Module author
     */
    public static $author = 'modules';

    /**
     * @inheritdoc
     */
    public function init() {
        if (static::$name === null) {
            throw new InvalidConfigException('The "name" property must be set.');
        }
        if ($this->isBackend) {
            $this->setViewPath(Yii::getAlias('@' . static::$author) . '/views/backend/' . static::$name);
            if ($this->controllerNamespace === null) {
                $this->controllerNamespace = str_replace('/','\\',static::$author) . '\\' . static::$name . '\\controllers\\backend';
            }
        } else if ($this->isApi) {
            if ($this->controllerNamespace === null) {
                $this->controllerNamespace = str_replace('/','\\',static::$author) . '\\' . static::$name . '\\controllers\\api';
            }
        } else if ($this->isConsole) {
            if ($this->controllerNamespace === null) {
                $this->controllerNamespace = str_replace('/','\\',static::$author) . '\\' . static::$name . '\\commands';
            }
        } else {
            /**
             * 前台需要兼容动态主题
             */
            if (is_object(Yii::$app->view->theme) && isset(Yii::$app->view->theme->template)) {
                $this->setViewPath(Yii::getAlias('@' . static::$author)  . '/views/frontend/themes/'.Yii::$app->view->theme->template.'/'.static::$name);
                $this->layout = '@' . static::$author.'/views/frontend/themes/'.Yii::$app->view->theme->template.'/layouts/main';
            } else {
                $this->setViewPath(Yii::getAlias('@' . static::$author)  . '/views/frontend/themes/default/'.static::$name);
                $this->layout = '@' . static::$author.'/views/frontend/themes/default/layouts/main';
            }

            if ($this->controllerNamespace === null) {
                $this->controllerNamespace = str_replace('/','\\',static::$author) . '\\' . static::$name . '\\controllers\\frontend';
            }
        }
        // Add module I18N category.
        if (!isset(Yii::$app->i18n->translations[static::$author.'/'.static::$name]) && !isset(Yii::$app->i18n->translations[static::$author.'/*'])) {
            Yii::$app->i18n->translations[static::$author.'/'.static::$name] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@'.static::$author.'/views/'.($this->isBackend ? 'backend':'frontend').'/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    static::$author.'/'.static::$name => static::$name.'.php'
                ]
            ];
        }
        parent::init();
    }

    public static function t($message, $params = [], $language = null) {
        $content = Yii::t(static::$author.'/' . static::$name, $message, $params, $language);
        if ($content == $message) {
            $content = Yii::t('common/'.Yii::$app->i18n->suffix,$message, $params, $language);
        }
        return $content;
    }
}
