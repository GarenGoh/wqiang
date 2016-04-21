<?php
use yii\data\ActiveDataProvider;

$where = Yii::$app->request->get();
$where['is_enable'] = 1;
$query = Yii::$app->articleService->search($where)
    ->orderBy(['id' => SORT_DESC]);

$provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 8
    ]
]);
$articles = $provider->getModels();

$this->params['pageId'] = 'php-index'
?>
<div class="col-md-9 primary-block">
    <div class="h1 category">
        PHP
    </div>
    <article class="col-md-12 item">
        <div class="pull-left">
            <a href="#"><img src="http://wqiang.net/images/1.jpg"></a>
        </div>
        <div class="col-md-12 pull-left right">
            <h4>安装PHP的curl扩展</h4>
            <p class="summary">中百度链接自动百度链接自动提交用到了curl，而自己安装PHP的时候并没有安装curl模块。通过查询PHP官方文档，得知编译PHP的时候需要带上-with-curl参数，才可以把curl模块编译进去。但是…</p>
            <p ><i class="fa fa-leaf leaf"></i> php学习&nbsp;&nbsp;&nbsp;
                <i class="fa fa-clock-o clock"></i> 2016-04-04&nbsp;&nbsp;&nbsp;
                <i class="fa fa-comment-o comment"></i> 评论（32）&nbsp;&nbsp;&nbsp;
                <i class="fa fa-eye eye"></i>浏览（323）&nbsp;&nbsp;&nbsp;
                <a class="pull-right" href="#">阅读原文>></a>
            </p>
        </div>
    </article>
    <article class="col-md-12 item">
        <div class="pull-left">
            <a href="#"><img src="http://wqiang.net/images/1.jpg"></a>
        </div>
        <div class="col-md-12 pull-left right">
            <h4>安装PHP的curl扩展</h4>
            <p class="summary">中百度链接自动百度链接自动提交用到了curl，而自己安装PHP的时候并没有安装curl模块。通过查询PHP官方文档，得知编译PHP的时候需要带上-with-curl参数，才可以把curl模块编译进去。但是…</p>
            <p ><i class="fa fa-leaf leaf"></i> php学习&nbsp;&nbsp;&nbsp;
                <i class="fa fa-clock-o clock"></i> 2016-04-04&nbsp;&nbsp;&nbsp;
                <i class="fa fa-comment-o comment"></i> 评论（32）&nbsp;&nbsp;&nbsp;
                <i class="fa fa-eye eye"></i>浏览（323）&nbsp;&nbsp;&nbsp;
                <a class="pull-right" href="#">阅读原文>></a>
            </p>
        </div>
    </article>
</div>
<div class="col-md-3 secondary-block">
    <div class="hot-article">
        <div class="head col-md-6">
            <h3>热门文章</h3>
        </div>
        <div class="col-md-12 body">
            <ul>
                <li>博客中百度链接自动提交用到了博客中百度链接自动提交用到了博客中百度链接自动提交用到了</li>
                <li>博客中百度链接自动提交用到了</li>
                <li>博客中百度链接自动提交用到了</li>
            </ul>
        </div>
    </div>
</div>
