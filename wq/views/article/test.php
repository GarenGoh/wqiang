<?php
use app\helpers\Tools;
?>
<html>
    <head>
        <title>学习与测试</title>
    </head>
    <body>
        <h3>语言切换：<small>配置在common.php</small></h3>
        <?php
        Tools::dev(Yii::t('yii','Update'));
        Tools::dev(Yii::t('cn2', 'cn'));
        Tools::dev(Yii::t('cn4', 'vi', [], 'vi'));
        ?>
    </body>
</html>

