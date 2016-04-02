<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
?>
<div>
    <div class="header col-md-12">
        <h1 class="title">用户管理</h1>
        <?= Html::a('<i class="fa fa-plus"></i> 创建用户', ['user/create', 'role' => Yii::$app->request->getQueryParam('role')], ['class' => 'btn btn-danger pull-right'])?>
    </div>
    <div class="col-md-10" style="float: left">
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
                    'username',
                    'name',
                    /*[
                        'attribute' => 'avatar',
                        'content' => function($model) {
                            $string = '';
                            if ($model->avatar_url) {
                                $string = '<a target="_blank" href="'.$model->avatar_url.'"><img class="img-circle" src="'.$model->avatar_url.'"></a>';
                            } else {
                                $string = '<i class="fa fa-picture-o"></i>';
                            }
                            return $string;
                        }
                    ],*/
                    [
                        'attribute' => 'email',
                        'content' => function($model) {
                            return '<span class="text-'.($model->is_email_enable?'success':'danger').'">'.$model->email.'</span>';
                        }
                    ],
                    [
                        'attribute' => 'mobile',
                        'content' => function($model) {
                            return '<span class="text-'.($model->is_mobile_enable?'success':'danger').'">'.$model->mobile.'</span>';
                        }
                    ],
                    [
                        'attribute' => 'is_enable',
                        'content' => function($model) {
                            $status = $model->is_enable ? 'success' : 'danger';
                            return '<span class="text-'.$status.'">'.User::getBooleanMap($model->is_enable).'</span>';
                        }
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:Y/m/d']
                    ],
                    [
                        'attribute' => 'logged_at',
                        'format' => ['date', 'php:Y/m/d']
                    ],
                    [
                        'content' => function($model) {
                            $buttons = [];
                            $buttons[] = Html::a('修改', ['user/update', 'id' => $model->id]);
                            $buttons[] = Html::a('删除', ['user/delete', 'id' => $model->id], ['data-method' => 'post', 'data-confirm' => '确定要删除吗？']);
                            return implode('&nbsp;&nbsp;', $buttons);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
    <div class="col-md-2" style="float: left">
    </div>
</div>
