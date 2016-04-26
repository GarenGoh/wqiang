<?php

namespace app\module\api\controllers;

use app\forms\UploadForm;
use app\helpers\Tools;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;

class FileController extends Controller
{
    public function actionFile()
    {
        if($_FILES) {
            $model = new UploadForm();
            $model->file = UploadedFile::getInstanceByName('file');
            $prefix = Yii::$app->request->getQueryParam('prefix');

            $imageName = $prefix.'/'.Tools::getRandChar(8). '.' . $model->file->extension;
            if ($model->file && $model->validate()) {
                $result = $model->file->saveAs('images/' . $imageName );
                if($result) {
                    //Tools::makeThumbnail('images/'.$imageName,'minimages/'.$imageName,'80','70');
                }
            }
        }
    }
}
