<?php
/* @var $this yii\web\View */
use app\helpers\Html;
use yii\helpers\Url;

$this->title = 'Garen 的主页';
$this->params['pageId'] = 'app-home';
$articles = Yii::$app->articleService->search()
    ->orderBy(['is_hot' => SORT_DESC, 'id' => SORT_DESC])
    ->limit(10)
    ->all();

?>
<div class="col-md-9 primary-block">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner sparkly" role="listbox">
            <div class="item active">
                <img src="<?=Yii::$app->params['uploadDir'].'default/admin2.jpg'?>" alt="" style="height: 400px;width: 100%">
                <div class="carousel-caption" style="text-align: left ">
                    <h3><a href="#" style="color: #fff">标题标题标题标题标题</a></h3>
                    <p><a href="#" style="color: #DDD">简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介</a></p>
                </div>
            </div>
            <div class="item">
                <img src="<?=Yii::$app->params['uploadDir'].'default/admin1.jpg'?>" alt="..." style="height: 400px;width: 100%">
                <div class="carousel-caption">
                    <h3>标题</h3>
                    <p>简介</p>
                </div>
            </div>
            <div class="item">
                <img src="<?=Yii::$app->params['uploadDir'].'default/admin3.jpg'?>" alt="..." style="height: 400px;width: 100%">
                <div class="carousel-caption">
                    <h3></h3>
                    <p></p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-chevron-left" style="margin-top: 150px;"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-chevron-right" style="margin-top: 150px;"></i>
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
            <div class="col-md-3 item">
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
    <div class="col-md-12 friendly">
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
