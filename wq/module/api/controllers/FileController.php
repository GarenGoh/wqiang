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
            $prefix = Yii::$app->request->getQueryParam('prefix', 'default');
            $name = Yii::$app->request->getQueryParam('name', 'file');

            $model = new UploadForm();
            $model->file = UploadedFile::getInstanceByName($name);

            $imageName = $prefix.'/'.Tools::getRandChar(8). '.' . $model->file->extension;
            if ($model->file && $model->validate()) {
                $result = $model->file->saveAs('images/' . $imageName );
                if($result) {
                    //缩略图
                    //Tools::makeThumbnail('images/'.$imageName,'minimages/'.$imageName,'80','70');
                }
            }
        }
    }
}
