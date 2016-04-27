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

$this->params['pageId'] = 'article-index';
?>
<div class="col-md-9 primary-block">
    <div class="h1 category">
        <?=strtoupper($category)?>
    </div>
    <?php
    foreach($articles as $a) {
    ?>
    <article class="col-md-12 item">
        <div class="pull-left left">
            <a href="<?=$a->url?>"><img src="<?=$a->imageUrl?>"></a>
        </div>
        <div class="col-md-12 pull-left right">
            <h4><a href="<?=$a->url?>"><?=$a->title?></a></h4>
            <p class="summary"><?=$a->summary?></p>
            <p ><i class="fa fa-leaf leaf"></i> php学习&nbsp;&nbsp;&nbsp;
                <i class="fa fa-clock-o clock"></i> <?=date('Y-m-d',$a->created_at) ?>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-comment-o comment"></i> 评论（32）&nbsp;&nbsp;&nbsp;
                <i class="fa fa-eye eye"></i>浏览（<?=$a->read_count?>）&nbsp;&nbsp;&nbsp;
                <a class="pull-right" href="#">阅读原文>></a>
            </p>
        </div>
    </article>
<?php }?>
</div>
<div class="col-md-3 secondary-block">
    <?php ?>
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
