<?php
/* @var $this yii\web\View */
/* @var $model app\models\User */

use yii\bootstrap\ActiveForm;
use app\helpers\Url;
use app\helpers\Html;

$form = ActiveForm::begin([
    'method' => 'post',
    'action' => Url::action(),
    'fieldConfig' => [
    ]
]);


?>
<?=$form->field($model, 'username')->textInput()?>
<?=$form->field($model, 'name')->textInput()?>
<?=$form->field($model, 'email')->textInput()?>
<?=$form->field($model, 'mobile')->textInput()?>
<?=$form->field($model, 'password')->textInput()?>
<?=$form->field($model, 'role_id')->textInput()?>
<?=$form->field($model, 'avatar_url')->textInput()?>
<?=$form->field($model, 'is_enable')->textInput()?>
<?=Html::submitButton('<i class="fa fa-paper-plane-o"></i> 提交保存', [
    'class' => 'btn btn-primary btn-block'
])?>
<?php
ActiveForm::end();
?>
