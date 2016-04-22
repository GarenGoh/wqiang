<?php
use yii\widgets\ActiveForm;
use app\helpers\Url;

$form = ActiveForm::begin([
    'method' => 'post',
    'action' => Url::to(['api/file/file']),
    'options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'file')->fileInput(['name' => 'UploadForm[]']);
echo $form->field($model, 'file')->fileInput(['name' => 'UploadForm[]'])

?>

    <button>Submit</button>

<?php ActiveForm::end() ?>
