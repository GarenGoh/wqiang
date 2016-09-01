<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Note;

?>
<div>
    <div class="header col-md-12">
        <h1 class="title">广告管理</h1>
        <?= Html::a('<i class="fa fa-plus"></i> 创建便签', ['note/create'], ['class' => 'btn btn-danger pull-right'])?>
    </div>
    <div class="col-md-10">
        <div class="table-responsive">
            <?= GridView::widget([
                'pager' => [
                    'firstPageLabel' => true,
                    'lastPageLabel' => true,
                    'maxButtonCount' => 5
                ],
                'layout' => "{items}\n{pager}{summary}",
                'tableOptions' => [
                    'class' => 'table table-striped table-hover'
                ],
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'title',
                        'content' => function($model) {
                            return Html::a(\app\helpers\Tools::string($model->title,10), '#');
                        }
                    ],

                    [
                        'attribute' => 'is_enable',
                        'content' => function($model) {
                            $status = $model->is_enable ? 'success' : 'danger';
                            return '<span class="text-'.$status.'">'.Note::getBooleanMap($model->is_enable).'</span>';
                        }
                    ],
                    'weight',
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:Y/m/d']
                    ],
                    [
                        'content' => function($model) {
                            $buttons = [];
                            $buttons[] = Html::a('修改', ['note/update', 'id' => $model->id]);
                            $buttons[] = Html::a('删除', ['note/delete', 'id' => $model->id], ['data-method' => 'post', 'data-confirm' => '确定要删除吗？']);
                            return implode('&nbsp;&nbsp;', $buttons);
                        }
                    ],
                ],
            ]);?>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>
