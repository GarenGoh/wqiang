<?php
/* @var $this \yii\web\View */
use app\helpers\Url;
use yii\web\View;

$this->params['pageId'] = 'article-view';
$hotArticles = Yii::$app->articleService->search(['category' => $model->category])
    ->select(['id', 'title', 'read_count'])
    ->limit(5)
    ->orderBy(['read_count' => SORT_DESC])
    ->all();
?>
<div class="col-md-12 nav">
    <p class="">
        <a class="pull-left home" href="<?=Yii::$app->request->hostInfo?>">网站首页</a>
        <a class="pull-left cate" href="<?=Url::to(['article/php'])?>">PHP</a>
        <span class="pull-right motto">天不随我意，我欲封天，唯一死尔！</span>
    </p>
</div>
<div class="col-md-9 article" style='background: repeat-y right url("<?=Yii::$app->params['line']?>");'>
    <h3 class="title"><?=$model->title?></h3>
    <p class="article-info">
        发布时间：<?=date('Y-m-d',$model->created_at)?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        编辑：garen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        阅读（<?=$model->read_count?>）</p>
    <div class="content">
        <?=$model->content?>
    </div>
</div>
<div class="col-md-3 secondary-block">
    <div class="hot-article">
        <div class="head col-md-4">
            <h4 class="title">热门文章</h4>
        </div>
        <div class="col-md-12 body">
            <ul>
                <?php foreach($hotArticles as $article) { ?>
                <li><a href="<?=$article->url?>"><?=$article->title?></a></li>
                <?php }?>
            </ul>
        </div>
    </div>
    <div class="article-tag col-md-12">
        <div class="head col-md-4">
            <h4 class="title">热门标签</h4>
        </div>
        <div class="col-md-12 body"></div>
        <div class="containe" style="margin-top: 30px;">
            <div class="hex" style="background: #986625;">
                <a href="#" class="h3" style="margin-top: 4px;" ">PHP</a>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>
            <div class="hex" style="background: #138898;">
                <a href="#" style="margin-top: 8px;font-size: 12px;">JavaScript</a>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>
            <div class="hex" style="background: #49980c;">
                <a href="#" class="h4" style="margin-top: 6px;">MySql</a>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>
            <div class="hex" style="background: #49980c;">
                <a href="#" style="font-size: 12px;margin-top: 8px;">Bootstrap</a>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>
            <div class="hex hex-half-neg" style="background: #49980c;">
                <a href="#"></a>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>

        </div>
    </div>
</div>
<?php
$js = "
$('.article-tag').sticky({
        'top': 0
      });
";
$this->registerJs($js, View::POS_END)
?>
