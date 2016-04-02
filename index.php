<?php

require(__DIR__ . '/wq/config/config.php');

require(__DIR__ . '/wq/vendor/autoload.php');
require(__DIR__ . '/wq/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/wq/config/web.php');

//print_r(new yii\web\Application($config));

(new yii\web\Application($config))->run();
