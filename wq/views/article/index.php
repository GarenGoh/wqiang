<?php
use yii\data\ActiveDataProvider;
use app\models\Article;
use yii\widgets\LinkPager;

$where = Yii::$app->request->get();
$where['category'] = $category;
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
$hotArticles = Yii::$app->articleService->search()
    ->select(['id', 'title', 'read_count'])
    ->limit(5)
    ->orderBy(['read_count' => SORT_DESC])
    ->all();
?>
<div class="col-md-9 primary-block">
    <div class="h1 category">
        <?=Article::getCategoryMap($category)?>
    </div>
    <?php
    foreach($articles as $a) {
    ?>
    <article class="col-md-12 item">
        <div class="pull-left left">
            <a href="<?=$a->url?>"><img src="<?=$a->image->url?>"></a>
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
    <div class="linkPager">
    <?php
    $linkPager = new LinkPager([
        'firstPageLabel' => true,
        'lastPageLabel' => true,
        'maxButtonCount' => 5,
        'pagination' => $provider->pagination
    ]);
    $linkPager->run();
    ?>
    </div>
</div>
<div class="col-md-3 secondary-block">
    <?php ?>
    <div class="hot-article">
        <div class="head col-md-6">
            <h3>热门文章</h3>
        </div>
        <div class="col-md-12 body">
            <ul>
                <?php foreach($hotArticles as $a) {?>
                <li><a href="<?=$a->url?>"><?=$a->title?></a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
