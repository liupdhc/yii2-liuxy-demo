<?php

return \yii\helpers\ArrayHelper::merge([
    'ttl' => 2592000,//缓存过期时间
],
    require(__DIR__ . '/env/params.' . YII_ENV . '.php'));
