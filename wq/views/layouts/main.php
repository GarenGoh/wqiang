<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use app\models\User;
use app\helpers\Url;
use app\models\Article;

AppAsset::register($this);
$currentUser = Yii::$app->user->getIdentity();
$navArticle = Article::getCategoryMap();
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
            <li class="nav pull-left"><a href="<?=Url::to(['note/index'])?>" >便签</a></li>
            <li class="nav pull-left"><a href="<?=Url::to(['site/about'])?>" >关于</a></li>
            <?php if(Yii::$app->user->isGuest){ ?>
            <li class="login pull-right"><a href="<?=Url::to(['site/register'])?>">注册</a>]</li>
            <li class="login pull-right">[<a href="<?=Url::to(['site/login'])?>">登录</a>|</li>
            <?php
            }else{ if($currentUser->role_id == User::ROLE_MANAGER || Yii::$app->userService->isRoot($currentUser->id)){
            ?>
            <li class="login pull-right"><a href="<?=Url::to(['site/logout'])?>">退出</a>]</li>
            <li class="login pull-right">[<a href="<?=Url::to(['admin/site'])?>">后台</a>|</li>
            <img class="user-avatar" src="<?=$currentUser->avatar_id?$currentUser->avatar->url:Yii::$app->params['defaultAvatarUrl']?>">
            <?php }else{?>
                <li class="pull-right login"><a href="<?=Url::to(['site/logout'])?>">退出</a></li>
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
    <div class="col-md-4 ">
        <a href="http://www.miitbeian.gov.cn/">京ICP备16014638号-1</a>
    </div>
    <div class="col-md-4 ">
        <a href="http://wqiang.net/">Garen.Goh个人博客</a> 内容版权所有，同时保留所有权利。
    </div>
    <div class="col-md-4 friendly-link">
        <p> 友情链接：<small><a href="https://www.sdk.cn/" target="_blank">SDK.cn</a><a href="http://xiajie.me/" target="_blank">Jerry's Blog</a></small></p>
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
