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
<div class="actGotop"><a href="javascript:;" title="返回顶部"></a></div>
    <div id="app-top">
        <div class="top">
            <div class="logo">
                <img src="<?=Yii::$app->params['logoUrl']?>">
            </div>
        </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- 手机端会把导航装进集装箱 -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=Url::to(['site/index'])?>">Garen's blog</a>
                </div>
                <!-- 导航条内容 -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php
                        $nav = Yii::$app->request->pathInfo;
                        ?>
                        <li class="<?=$nav=='article/php'?'active':''?>"><a href="<?=Url::to(['article/php'])?>">PHP</a></li>
                        <li class="<?=$nav=='article/db'?'active':''?>"><a href="<?=Url::to(['article/db'])?>">数据库</a></li>
                        <li class="<?=$nav=='article/linux'?'active':''?>"><a href="<?=Url::to(['article/linux'])?>">Linux</a></li>
                        <li class="<?=($nav=='article/frontend'||$nav=='article/learn')?'active':''?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">其他博文 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=Url::to(['article/frontend'])?>">前端</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?=Url::to(['article/learn'])?>">学无止境</a></li>
                            </ul>
                        </li>
                        <li class="<?=$nav=='note/index'?'active':''?>"><a href="<?=Url::to(['note/index'])?>">便签</a></li>
                        <li class="<?=$nav=='site/about'?'active':''?>"><a href="<?=Url::to(['site/about'])?>">关于</a></li>
                    </ul>
                    <form class="navbar-form navbar-left pc-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">搜索</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php if(Yii::$app->user->isGuest) {?>
                                <li><a href="<?=Url::to(['site/login'])?>">登录</a></li>
                                <?php }else {?>
                                    <?php if(Yii::$app->userService->isRoot(Yii::$app->user->getId())) {?>
                                        <li><a href="<?=Url::to(['admin/site/index'])?>">后台</a></li>
                                <li role="separator" class="divider"></li>
                                        <?php }?>
                                <li><a href="<?=Url::to(['site/logout'])?>">退出</a></li>
                                <?php }?>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
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
<footer class="content-wrapper container" id="app-footer">
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
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
