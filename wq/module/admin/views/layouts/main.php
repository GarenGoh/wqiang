<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
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
<div style="height: 60px;background-color: #3e6aa5;margin: 0;">
    <div style="float: right;padding-top: 6px;">
        [<a style="color: #eeffde" href="<?=Yii::$app->request->hostInfo?>">前台</a>|<a style="color: #eeffde" href="<?=Url::to(['site/logout'])?>">退出</a>]
    </div>
    <div style="float: right;">
        <img style="width: 30px;height: 30px;border-radius: 15px;" src="<?=$currentUser->avatar_url?$currentUser->avatar_url:Yii::$app->params['defaultAvatarUrl']?>">
    </div>
    <div>
        <ul style="padding: 20px 5px 0;margin: 0">
            <li style="list-style-type: none;float: left;margin-right: 40px;margin-bottom: -2px;"><a href="<?=Url::to(['site/index'])?>"><img style="height: 60px;margin-top: -20px;" src="<?=Yii::$app->params['logoUrl']?>"></a></li>
            <li style="border-top-right-radius: 5px;border-top-left-radius:5px;text-align:center;background-color: #538dc4;font-size: 20px;border: solid #3068a0 1px;width: 100px;list-style-type: none;float: left;margin: 0 15px;padding: 5px;"><a href="<?=Url::to(['user/index'])?>" style="color: #fff;text-decoration : none">用&nbsp;&nbsp;户</a></li>
            <li style="border-top-right-radius: 5px;border-top-left-radius:5px;text-align:center;background-color: #538dc4;font-size: 20px;border: solid #3068a0 1px;width: 100px;list-style-type: none;float: left;margin: 0 15px;padding: 5px;"><a href="/admin/article/index" style="color: #fff;text-decoration : none">文&nbsp;&nbsp;章</a></li>
            <li style="border-top-right-radius: 5px;border-top-left-radius:5px;text-align:center;background-color: #538dc4;font-size: 20px;border: solid #3068a0 1px;width: 100px;list-style-type: none;float: left;margin: 0 15px;padding: 5px;"><a href="/admin/advert/index" style="color: #fff;text-decoration : none">广&nbsp;告&nbsp;位</a></li>
            <li style="border-top-right-radius: 5px;border-top-left-radius:5px;text-align:center;background-color: #538dc4;font-size: 20px;border: solid #3068a0 1px;width: 100px;list-style-type: none;float: left;margin: 0 15px;padding: 5px;"><a href="/admin/page/index" style="color: #fff;text-decoration : none">页&nbsp;&nbsp;面</a></li>
        </ul>
    </div>
</div>
    <div style="margin: 0;">
        <?= $content ?>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
