<?php

namespace app\module\api\controllers;

use app\helpers\Tools;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use Yii;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

class FileController extends Controller
{
    public $accessKey = 'svUrrWvsAiMgwOGcYE5VwHE9KfFKuy_aZ_NGuFuE';
    public $secretKey = 'QzoW6iNNbz2uUY0X9r4MiNqVBCk2FeUiNbEqIwUh';
    public $bucket = 'wqiang';

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

    public function actionEditorFile()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if($_FILES) {
            $uploadedFile = UploadedFile::getInstanceByName('image');//要被上传的文件
            $newName = 'editor/'.Tools::getRandChar(8). '.' . $uploadedFile->extension;
            $auth = new Auth($this->accessKey, $this->secretKey);
            $token = $auth->uploadToken($this->bucket);

            $upManager = new UploadManager();
            list($ret, $err) = $upManager->putFile($token, $newName, $uploadedFile->tempName, null, $uploadedFile->type);
            if($err !== null) {
                return ['success' => false, 'msg' => 'fuck!'];
            }else {
                $file_path = Yii::$app->params['qiniu_dm'].$newName;
                return ['success' => true, 'file_path' => $file_path];
            }
        }
        return ['success' => false, 'msg' => 'fuck!'];


    }
}
