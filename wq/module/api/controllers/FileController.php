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
            $uploadedFile = UploadedFile::getInstanceByName($name);//要被上传的文件
            $newName = Tools::getRandChar(8). '.' . $uploadedFile->extension;
            $options = [
                'prefix' => $prefix.'/',
                'newName' => $newName
            ];

            if ($uploadedFile) {
                $result = $uploadedFile->saveAs('images/'.$prefix.'/'.$newName );//上传文件
                if($result) {
                    //缩略图
                    //Tools::makeThumbnail('images/'.$newName,'minimages/'.$newName,'80','70');
                    $save = Yii::$app->fileService->saveToDb($uploadedFile, $options);
                    return $save;
                }
            }
        }
    }
}
