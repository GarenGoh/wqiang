<?php
require(__DIR__ . '/wq/config/config.php');

require(__DIR__ . '/wq/vendor/autoload.php');
require(__DIR__ . '/wq/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/wq/config/web.php');

(new yii\web\Application($config))->run();