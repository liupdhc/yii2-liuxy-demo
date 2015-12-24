<?php

return \yii\helpers\ArrayHelper::merge([
    'perm.maxlevel' => 10//设置菜单支持的级别，必须大于等于5
], require(__DIR__ . '/env/params.' . YII_ENV . '.php'));
