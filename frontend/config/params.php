<?php

return \yii\helpers\ArrayHelper::merge([
    'template' => 'default'
], require(__DIR__ . '/env/params.' . YII_ENV . '.php'));
