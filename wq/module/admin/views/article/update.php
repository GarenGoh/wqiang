<?php
/* @var $this yii\web\View */
/* @var $model app\models\Article */

use yii\bootstrap\ActiveForm;
use app\helpers\Url;
use app\helpers\Html;
use app\models\Article;
use yii\web\View;

$form = ActiveForm::begin([
    'method' => 'post',
    'action' => Url::action(),
    'fieldConfig' => [
        'class' => 'app\module\admin\widgets\AdminActiveField'
    ]
]);
?>
<div >
    <div class="col-sm-2">

    </div>
    <div class="col-sm-10">
        <h2><?=$model->isNewRecord?"创建":"更新"?>文章</h2>
        <?=$form->field($model, 'title')->textInput()?>
        <?=$form->field($model, 'image_url', [
            'labelOptions' => [
                'label' => $model->getAttributeLabel('image')
            ]
        ])->image(['prefix' => 'article'])?>
        <?=$form->field($model, 'category')->dropDownList(Article::getCategoryMap(), ['prompt'=>'选择分类','style'=>'width:100%'])?>
        <?=$form->field($model, 'keywords')->textInput(['placeholder' => '多个关键词以“,”隔开'])?>
        <?=$form->field($model, 'is_hot')->dropDownList(Article::getBooleanMap(), ['prompt'=>'该文章是否排在所有文章之前','style'=>'width:100%'])?>
        <?=$form->field($model, 'is_enable')->dropDownList(Article::getBooleanMap(),['prompt'=>'该文章在前台是否显示','style'=>'width:100%'])?>
        <?=$form->field($model, 'summary')->textarea()?>
        <?=$form->field($model, 'content')->textarea(['id'=>"editor",'placeholder'=>"这里输入内容",'autofocus'=>true])?>
        <?=$form->field($model, 'read_count')->textInput()?>
        <?=Html::submitButton('提交保存', [
            'class' => 'btn btn-primary btn-block'
        ])?>
    </div>
</div>
<?php
ActiveForm::end();
$js = "var editor = new Simditor({
        textarea: $('#editor')
    });";
$this->registerJs($js,View::POS_END)
?>
