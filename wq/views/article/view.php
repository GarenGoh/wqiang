<?php
use app\helpers\Url;

$this->params['pageId'] = 'article-view';
?>
<div class="col-md-12 nav">
    <p class="">
        <a class="pull-left home" href="<?=Yii::$app->request->hostInfo?>">网站首页</a>
        <a class="pull-left cate" href="<?=Url::to(['article/php'])?>">PHP</a>
        <span class="pull-right motto">天不随我意，我欲封天，唯一死尔！</span>
    </p>
</div>
<div class="col-md-9 article">
    <h3 class="title"><?=$model->title?></h3>
    <p class="article-info">
        发布时间：<?=date('Y-m-d',$model->created_at)?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        编辑：garen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        阅读（<?=$model->read_count?>）</p>
    <div class="content">
        <?=$model->content?>
    </div>
</div>
<div class="col-md-3 secondary-block">
    <div class=" hot-article" style="background: #eee;">
        <div class="head col-md-6">
            <h3>热门文章</h3>
        </div>
        <div class="col-md-12 body">
            <ul class="clone" clone="7">
                <li>博客中百度链接自动提交用到了</li>
                <li>博客中百度链接自动提交用到了</li>
                <li>博客中百度链接自动提交用到了</li>
                <li>博客中百度链接自动提交用到了</li>
                <li>博客中百度链接自动提交用到了</li>
                <li>博客中百度链接自动提交用到了</li>
            </ul>
        </div>
    </div>
    <div class="article-tag col-md-12">
        <div>
            <h3>热门标签</h3>
        </div>
        <div class="containe" >
            <div class="hex" style="background: #986625;">
                <p  class="h3" style="color: #fff;margin: 0">php</p>
                <a href="#"></a>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>
            <div class="hex" style="background: #138898;">
                <h6 style="color: #fff;margin: 0;width: 32px;">JavaScripts</h6>
                <a href="#"></a>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>
            <div class="hex" style="background: #49980c;">
                <a href="#"></a>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>

        </div>
    </div>
</div>
