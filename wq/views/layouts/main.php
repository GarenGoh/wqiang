<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\User;
use yii\web\View;
AppAsset::register($this);
$currentUser = Yii::$app->user->getIdentity();
$css = <<< CSS
.left {
float: left;
}
.right {
float: right;
}
.top {
background-color: #15a085;
height: 190px;
width: 100%;
padding-top: 15px;
}
.logo {
height: 160px;
width: 160px;
border-radius: 160px;
background-color: #fff;
margin-left: auto;
margin-right: auto;
overflow:hidden;
}
.logo img {
height: 160px;
width: 160px;
}
.item {
height: 50px;
background-color: #05435c;
}
.item ul {
margin: 0;
padding: 10px 5px 0 5%;
}
.item .navbar {
font-size: 19px;
list-style-type: none;
}
.item .navbar a {
color: #fff;
padding: 0 30px 0;
}
.item .navbar .login {
padding: 0 5px 0;
}
.user-avatar {
background: #fff;
float: right;
border: solid 1px #ddd;
overflow:hidden;
width: 30px;
height: 30px;
border-radius: 15px;
}
.flash-message {
width: 40%;
margin-left: auto;
margin-right: auto;
}
.footer {
background-color: #05435c;
height: auto;
width: 100%;
padding: 30px 30px 0;
}
.footer p {
color: #fff;margin: 0;font-size: 20px
}
.footer ul {
padding-left: 0
}
.footer a {
color: #fff;padding: 5px;
}
.hot li {
float: left;list-style-type: none;border: solid 1px #ddd;margin-right: 5px;margin-bottom: 10px;
}
.friendly-link li {
float: left;list-style-type: none;margin-right: 5px;margin-bottom: 10px;
}

.message .alert {
    display: none;
    width: 40%;
    margin: 0 auto;
}
CSS;
$this->registerCss($css);

$js = '
    $(".on").bind("click",function(){
        var iID=setInterval(article, 1000);
        $(".off").bind("click",function(){
            clearInterval(iID);
        });
    });

    function article(){
        $("#test").html(Date());
    }
';

$this->registerJs($js, View::POS_END);
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
    <div class="col-md-12 top">
        <div class="logo">
            <img src="<?=Yii::$app->params['logoUrl']?>">
        </div>
    </div>
    <div class="col-md-12 item">
        <ul>
            <li class="navbar left"><a href="<?=Yii::$app->homeUrl?>">首页</a></li>
            <li class="navbar left"><a href="#" >PHP</a></li>
            <li class="navbar left"><a href="#" >前端</a></li>
            <li class="navbar left"><a href="#" >关于我</a></li>
            <li class="navbar left"><a href="javascript:void(0)" class="on">on</a></li>
            <li class="navbar left"><a href="#" id="test"></a></li>
            <?php if(Yii::$app->user->isGuest){ ?>
            <li class="navbar right"><a href="<?=Url::to(['site/register'])?>" class="login">注册</a></li>
            <li class="navbar right"><a href="<?=Url::to(['site/login'])?>" class="login">登录</a></li>
            <?php
            }else{ if($currentUser->role_id == User::ROLE_MANAGER || Yii::$app->userService->isRoot($currentUser->id)){
            ?>
            <li class="navbar right"><a href="<?=Url::to(['site/logout'])?>" class="login">退出</a>]</li>
            <li class="navbar right">[<a href="<?=Url::to(['admin/site'])?>" class="login">后台</a>|</li>
            <img class="user-avatar" src="<?=$currentUser->avatar_url?$currentUser->avatar_url:Yii::$app->params['defaultAvatarUrl']?>">
            <?php }else{?>
                <li class="right navbar"><a href="<?=Url::to(['site/logout'])?>" class="login">退出</a></li>
                <img class="user-avatar" src="<?=$currentUser->avatar_url?$currentUser->avatar_url:Yii::$app->params['defaultAvatarUrl']?>">
            <?php }}?>
        </ul>
    </div>
    <div class="content-wrapper container col-md-12" id="<?=isset($this->params['pageId']) ? $this->params['pageId']:''?>" style="margin: 0;padding: 0;">
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
                <p class="flash-message" style="background-color: <?=$type=='error'?'#ff7974' : '#49b9f9'?>"><?=$message?></p>
           <?php }
            ?>
        </div>
            <?=$content ?>
    </div>
<footer class="col-md-12 footer">
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
