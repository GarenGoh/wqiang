<?php
/* @var $this yii\web\View */
use app\helpers\Html;
use yii\web\View;
use app\helpers\Url;

$this->title = 'Garen 的主页';
$this->params['pageId'] = 'app-home';
$articles = Yii::$app->articleService->search()
    ->orderBy(['is_hot' => SORT_DESC, 'id' => SORT_DESC])
    ->limit(10)
    ->all();
$adverts = Yii::$app->advertService->search()
    ->orderBy(['weight' => SORT_DESC, 'id' => SORT_DESC])
    ->limit(4)
    ->all();
$ad_0 = $adverts[0];
unset($adverts[0]);
?>
<div class="col-md-9 primary-block">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <?php foreach($adverts as $k => $ad) {?>
            <li data-target="#carousel-example-generic" data-slide-to="<?=$k?>"></li>
            <?php }?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner sparkly" role="listbox">
            <div class="item active">
                <a href="<?=$ad->link?>"><img src="<?=$ad_0->image->url?>"></a>
                <div class="carousel-caption ad-text">
                    <h3><a href="<?=$ad_0->link?>" class="ad-title"><?=$ad_0->title?></a></h3>
                    <p><a href="<?=$ad_0->link?>" class="ad-summary"><?=$ad_0->summary?></a></p>
                </div>
            </div>
            <?php foreach($adverts as $ad) {?>
            <div class="item">
                <a href="<?=$ad->link?>"><img src="<?=$ad->image->url?>"></a>
                <div class="carousel-caption ad-text">
                    <h3><a href="<?=$ad->link?>" class="ad-title"><?=$ad->title?></a></h3>
                    <p><a href="<?=$ad->link?>" class="ad-summary"><?=$ad->summary?></a></p>
                </div>
            </div>
            <?php }?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-chevron-right"></i>
            <span class="sr-only">next</span>
        </a>
    </div>
    <div class="article">
        <div class="new-article">
            <h4>最新文章 <small class="pull-right"><a href="#">最新文章最新文章</a></small></h4>
        </div>
        <div>
            <?php foreach($articles as $a) {?>
                <article class="col-md-12 item">
                    <div class="pull-left left">
                        <a href="<?=$a->url?>"><img src="<?=$a->image->url?>"></a>
                    </div>
                    <div class="col-md-12 pull-left right">
                        <h4><a href="<?=$a->url?>"><?=$a->title?></a></h4>
                        <p class="summary"><?=Html::string($a->summary, 30)?></p>
                        <p ><i class="fa fa-leaf leaf"></i>
                            <?php
                            if($a->keywords) {
                                $n=strpos($a->keywords,',');
                                echo $n ? substr($a->keywords,0,$n) : $a->keywords;
                            }
                            ?>&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-clock-o clock"></i> <?=date('Y-m-d',$a->created_at)?>&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-comment-o comment"></i> 评论（32）&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-eye eye"></i>浏览（<?=$a->read_count?>）&nbsp;&nbsp;&nbsp;
                            <a class="pull-right" href="<?=$a->url?>">阅读原文>></a>
                        </p>
                    </div>
                </article>
            <?php }?>
        </div>
    </div>
</div>
<div class="col-md-3 second-block">
    <div class="follow col-md-12">
        <div class="head">
            <h4>关注我</h4>
        </div>
        <div class="body">
            <div class="col-md-3 item">
                <i class="fa fa-github"></i>
                <p class="sparkly-p"><a href="https://github.com/GarenGoh">GitHub</a></p>
            </div>
            <div class="col-md-3 item">
                <i class="fa fa-weibo" style="color: #FE2A27;"></i>
                <p class="sparkly-p"><a href="http://weibo.com/wuqiangbaba">微 博</a></p>
            </div>
            <div class="col-md-3 item" id="wechat-panel">
                <i class="fa fa-wechat" style="color: #3DAF36;"></i>
                <p class="sparkly-p"><a href="#">微 信</a></p>
            </div>
            <div class="col-md-3 item">
                <i class="fa fa-envelope-o" style="color: #FFB902;"></i>
                <p class="sparkly-p"><a href="#">邮 箱</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 about-me">
        <div class="head img">
            <a href="<?=Url::to(['site/about'])?>"><img src="<?=Yii::$app->params['uploadDir'].'default/admin2.jpg'?>"></a>
        </div>
        <div class="body">
            <p>网名：<small>Garen.Goh</small></p>
            <p>职业：<small>PHP工程师</small></p>
            <p>主页：<small>wqiang.net</small></p>
            <p>现居：<small>北京.海淀</small></p>
            <p>格言：<small>努力让自己吊到爆</small></p>
        </div>
    </div>
    <div class="col-md-12 hot-tag">
        <div class="head">
            <h4>热门标签</h4>
        </div>
        <div class="body">
            <div class="containe" style="margin-top: 30px;">
                <div class="hex" style="background: #986625;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'gulp',])?>" class="h3" style="margin-top: 4px;" ">Gulp</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex" style="background: #138898;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'javascript',])?>" style="margin-top: 8px;font-size: 12px;">JavaScript</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex hex-one" style="background: #49980c;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'mysql',])?>" class="h4" style="margin-top: 6px;">MySql</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex hex-half" style="background: #585398;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'bootstrap',])?>" style="font-size: 12px;margin-top: 8px;">Bootstrap</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex" style="background: #984718;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'less',])?>" style="font-size: 12px;margin-top: 8px;">Less</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex" style="background: #339858;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'jquery',])?>" class="h4" style="margin-top: 6px;">jQuery</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex" style="background: #986625;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'yii',])?>" class="h3" style="margin-top: 4px;">Yii2</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex hex-one" style="background: #138898;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'thinkphp',])?>" style="margin-top: 8px;font-size: 12px;">ThinkPHP</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex" style="background: #987318;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'nginx',])?>" class="h4" style="margin-top: 6px;">Nginx</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex hex-half" style="background: #986625;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'git',])?>" class="h3" style="margin-top: 4px;">Git</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex hex-one" style="background: #416b98;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'laravel',])?>" class="h5" style="margin-top: 10px;">Laravel</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex hex-one" style="background: #49980c;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'ajax',])?>" class="h4" style="margin-top: 6px;">ajax</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex" style="background: #735898;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'css',])?>" class="h3" style="margin-top: 4px;">CSS</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex" style="background: #985374;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'seo',])?>" class="h3" style="margin-top: 4px;">SEO</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
                <div class="hex hex-half" style="background: #20988e;">
                    <a href="<?=Url::to(['article/hot_tag', 'tag' => 'apache',])?>" class="h4" style="margin-top: 6px;">apache</a>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 friendly" style="z-index: -1;">
        <div class="head">
            <h4>友情链接:</h4>
        </div>
        <div class="body">
            <ul>
                <li><a href="">友链是打</a></li>
                <li><a href="">死车</a></li>
                <li><a href="">车</a></li>
                <li><a href="">友链死</a></li>
                <li><a href="">友链死</a></li>
                <li><a href="">友链死的救</a></li>
            </ul>
        </div>

    </div>
</div>
<?php
$js_wechat="
$('#wechat-panel').popover({
        'trigger': 'hover',
        'html': true,
        'placement': 'top',
        'title': '添加我为微信好友',
        'content': '<img src=\"".Yii::$app->params['wechatImageUrl']."\" style=\"height: 150px;width: 150px\">'
      });
";
$this->registerJs($js_wechat, View::POS_END);
?>
