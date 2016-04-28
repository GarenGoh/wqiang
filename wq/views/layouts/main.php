<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use app\models\User;
use app\helpers\Url;

AppAsset::register($this);
$currentUser = Yii::$app->user->getIdentity();
$navArticle = \app\models\Article::getCategoryMap();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <nav id="app-top">
    <div class="top">
        <div class="logo">
            <img src="<?=Yii::$app->params['logoUrl']?>">
        </div>
    </div>
    <div class="item" id="navbar">
        <ul>
            <li class="nav pull-left"><a href="<?=Yii::$app->homeUrl?>">首页</a></li>
            <?php foreach($navArticle as $k => $v) {?>
            <li class="nav pull-left"><a href="<?=Url::to(['article/'.$k])?>" ><?=$v?></a></li>
            <?php }?>
            <li class="nav pull-left"><a href="<?=Url::to(['site/about'])?>" >关于我</a></li>
            <?php if(Yii::$app->user->isGuest){ ?>
            <li class="nav pull-right"><a href="<?=Url::to(['site/register'])?>" class="login">注册</a></li>
            <li class="nav pull-right"><a href="<?=Url::to(['site/login'])?>" class="login">登录</a></li>
            <?php
            }else{ if($currentUser->role_id == User::ROLE_MANAGER || Yii::$app->userService->isRoot($currentUser->id)){
            ?>
            <li class="nav pull-right"><a href="<?=Url::to(['site/logout'])?>" class="login">退出</a>]</li>
            <li class="nav pull-right">[<a href="<?=Url::to(['admin/site'])?>" class="login">后台</a>|</li>
            <img class="user-avatar" src="<?=$currentUser->avatar_id?$currentUser->avatar->url:Yii::$app->params['defaultAvatarUrl']?>">
            <?php }else{?>
                <li class="pull-right nav"><a href="<?=Url::to(['site/logout'])?>" class="login">退出</a></li>
                <img class="user-avatar" src="<?=$currentUser->avatar_id?$currentUser->avatar->url:Yii::$app->params['defaultAvatarUrl']?>">
            <?php }}?>
        </ul>
    </div>
    </nav>
    <div class="content-wrapper container" id="<?=isset($this->params['pageId']) ? $this->params['pageId']:''?>">
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
            if ($message && $type) {?>
                <p style="width: 40%;margin-left: auto;margin-right: auto;background-color: <?=$type=='error'?'#ff7974' : '#49b9f9'?>"><?=$message?></p>
           <?php }
            ?>
        </div>
            <?=$content ?>
    </div>
<footer class="col-md-12" id="app-footer">
    <div class="col-md-4" >
        <ul>
            <li style="font-size: 20px;list-style-type: none;margin-bottom: 60px;"><a href="#">关于我</a></li>
            <li style="font-size: 20px;list-style-type: none;"><a href="#">联系我</a></li>
        </ul>
    </div>
    <div class="col-md-4 hot">
        <p > 热门标签：</p>
        <ul >
            <li><a href="javascript:void(0)">Yii</a></li>
            <li><a href="#">JAVA</a></li>
            <li><a href="#">HTML</a></li>
            <li><a href="#">Git</a></li>
            <li><a href="#">PHP</a></li>
            <li><a href="#">ThinkPHP</a></li>
            <li><a href="#">CI</a></li>
            <li><a href="#">MySQL</a></li>
            <li><a href="#">Nginx</a></li>
            <li><a href="#">Linux</a></li>
            <li><a href="#">服务器</a></li>
            <li><a href="#">哈哈哈</a></li>
            <li><a href="http://www.miitbeian.gov.cn/">京ICP备16014638号-1</a></li>
        </ul>
    </div>
    <div class="col-md-4 friendly-link">
        <p> 友情链接：</p>
        <ul>
            <li><a href="#">Yii</a></li>
            <li><a href="#">JAVA</a></li>
            <li><a href="#">HTML</a></li>
            <li><a href="#">Git</a></li>
            <li><a href="#">PHP</a></li>
            <li><a href="#">ThinkPHP</a></li>
            <li><a href="#">CI</a></li>
            <li><a href="#">MySQL</a></li>
            <li><a href="#">Nginx</a></li>
            <li><a href="#">Linux</a></li>
            <li><a href="#">服务器</a></li>
            <li><a href="#">哈哈哈</a></li>
        </ul>
    </div>
</footer>
<?php
/*$js = "
$('#navbar').sticky({
    'top': 0
});";
$this->registerJs($js, View::POS_END);
*/?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
