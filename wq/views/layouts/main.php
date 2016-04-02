<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\User;

AppAsset::register($this);
$currentUser = Yii::$app->user->getIdentity();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div style="background-color: #15a085;height: 190px;width: 100%;padding-top: 15px;">
        <div style="height: 160px;width: 160px;border-radius: 160px;background-color: #fff;margin-left: auto;margin-right: auto;overflow:hidden">
            <img style="height: 160px;width: 160px;" src="<?=Yii::$app->params['logoUrl']?>">
        </div>
    </div>
    <div style="height: 50px;background-color: #05435c">
        <ul style="margin: 0;padding: 10px 5px 0 5%;">
            <li style="float: left;font-size: 19px;list-style-type: none;"><a href="<?=Yii::$app->homeUrl?>" style="color: #fff;padding: 0 30px 0;">首页</a></li>
            <li style="float: left;font-size: 19px;list-style-type: none;"><a href="#" style="color: #fff;padding: 0 30px 0;">PHP</a></li>
            <li style="float: left;font-size: 19px;list-style-type: none;"><a href="#" style="color: #fff;padding: 0 30px 0;">前端</a></li>
            <li style="float: left;font-size: 19px;list-style-type: none;"><a href="#" style="color: #fff;padding: 0 30px 0;">关于我</a></li>
            <?php if(Yii::$app->user->isGuest){ ?>
            <li style="float: right;font-size: 19px;list-style-type: none;"><a href="<?=Url::to(['site/register'])?>" style="color: #fff;padding: 0 5px 0;">注册</a></li>
            <li style="float: right;font-size: 19px;list-style-type: none;"><a href="<?=Url::to(['site/login'])?>" style="color: #fff;padding: 0 5px 0;">登录</a></li>
            <?php
            }else{ if($currentUser->role_id == User::ROLE_MANAGER){
            ?>
            <li style="float: right;font-size: 19px;list-style-type: none;"><a href="<?=Url::to(['site/logout'])?>" style="color: #fff;padding: 0 5px 0;">退出</a>]</li>
            <li style="float: right;font-size: 19px;list-style-type: none;">[<a href="<?=Url::to(['admin/site'])?>" style="color: #fff;padding: 0 5px 0;">后台</a>|</li>
            <img style="background: #fff;float: right;border: solid 1px #ddd;overflow:hidden;width: 30px;height: 30px;border-radius: 15px;" src="<?=$currentUser->avatar_url?$currentUser->avatar_url:Yii::$app->params['defaultAvatarUrl']?>">
            <?php }else{?>
                <li style="float: right;font-size: 19px;list-style-type: none;"><a href="<?=Url::to(['site/logout'])?>" style="color: #fff;padding: 0 5px 0;">退出</a></li>
                <img style="background: #fff;float: right;border: solid 1px #ddd;overflow:hidden;width: 30px;height: 30px;border-radius: 15px;" src="<?=$currentUser->avatar_url?$currentUser->avatar_url:Yii::$app->params['defaultAvatarUrl']?>">
            <?php }}?>
        </ul>
    </div>
    <div class="content-wrapper container" id="<?=isset($this->params['pageId']) ? $this->params['pageId']:''?>">
        <div class="col-md-12" style="text-align: center">
            <?php
            $type = '';
            $message = '';
            if ($message = Yii::$app->session->getFlash('app_success_flash_message')) {
                $type = 'success';
            } else {
                $message = Yii::$app->session->getFlash('app_error_flash_message');
                $type = 'error';
            }
            if ($message && $type) {?>
                <p style="width: 40%;margin-left: auto;margin-right: auto; background-color: <?=$type=='error'?'#ff7974' : '#49b9f9'?>"><?=$message?></p>
           <?php }
            ?>
        </div>
        <?= $content ?>
    </div>
<footer style="background-color: #05435c;height: 200px;width: 100%;padding: 30px 30px 0;margin-top: 10px;">
    <div class="col-md-4" style=";">
        <ul >
            <li style="font-size: 20px;list-style-type: none;margin-bottom: 60px;"><a href="#" style="color: #fff">关于我</a></li>
            <li style="font-size: 20px;list-style-type: none;"><a href="#" style="color: #fff">联系我</a></li>
        </ul>
    </div>
    <div class="col-md-4">
        <p style="color: #fff;margin: 0;font-size: 20px"> 热门标签：</p>
        <ul style="padding-left: 0">
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">Yii</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">JAVA</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">HTML</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">Git</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">PHP</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">ThinkPHP</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">CI</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">MySQL</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">Nginx</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">Linux</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">服务器</a></li>
            <li style="float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">哈哈哈</a></li>
        </ul>
    </div>
    <div class="col-md-4" style=";">
        <p style="color: #fff;margin: 0;font-size: 20px"> 友情链接：</p>
        <ul style="padding-left: 0">
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">Yii</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">JAVA</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">HTML</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">Git</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">PHP</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">ThinkPHP</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">CI</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">MySQL</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">Nginx</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">Linux</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">服务器</a></li>
            <li style="float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px; "><a href="#" style="color: #fff;padding: 5px;">哈哈哈</a></li>
        </ul>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
