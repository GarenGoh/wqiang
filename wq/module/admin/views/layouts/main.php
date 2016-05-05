<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\helpers\Url;
use app\module\admin\asset\AdminAsset;

AdminAsset::register($this);
$currentUser = Yii::$app->user->getIdentity();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language ?>">
<head>
    <meta charset="<?=Yii::$app->charset ?>">
<!--    解决400报错：您提交的数据无法被验证-->
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="margin: 0;">
<?php $this->beginBody() ?>
<div id="admin-top">
    <div class="logout">
        [<a href="<?=Yii::$app->request->hostInfo?>">前台</a>|<a href="<?=Url::to(['site/logout'])?>">退出</a>]
    </div>
    <div class="admin-avatar">
        <img src="<?=$currentUser->avatar_id?$currentUser->avatar->url:Yii::$app->params['defaultAvatarUrl']?>">
    </div>
    <div>
        <ul class="admin-navbar">
            <li class="logo"><a href="<?=Url::to(['site/index'])?>"><img src="<?=Yii::$app->params['logoUrl']?>"></a></li>
            <li class="nav"><a href="<?=Url::to(['user/index'])?>">用&nbsp;&nbsp;户</a></li>
            <li class="nav"><a href="<?=Url::to(['article/index'])?>">文&nbsp;&nbsp;章</a></li>
            <li class="nav"><a href="<?=Url::to(['advert/index'])?>">广&nbsp;告&nbsp;位</a></li>
            <li class="nav"><a href="#">页&nbsp;&nbsp;面</a></li>
        </ul>
    </div>
</div>
    <div class="admin-content">
        <div style="text-align: center;">
            <?php
            $type = '';
            $message = '';
            if ($message = Yii::$app->session->getFlash('app_success_flash_message')) {
                $type = 'success';
            } else {
                $message = Yii::$app->session->getFlash('app_error_flash_message');
                $type = 'error';
            }
            if ($message && $type) {

                echo '<h1>main</h1>';
                //$js = "Message.{$type}('".addslashes($message)."');";
                //$this->registerJs($js, \yii\web\View::POS_END);
            }
            ?>
        </div>
        <?= $content ?>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
