<?php
namespace app\controllers;

use app\forms\UploadForm;
use app\helpers\Tools;
use app\models\Article;
use Yii;
use yii\web\UploadedFile;

class ArticleController extends BaseController
{
    public function actionPhp()
    {
        return $this->render('index',[
            'category' => Article::CATEGORY_PHP
        ]);
    }

    public function actionTest()
    {
        $model = new UploadForm();

        return $this->renderPartial('test',[
            'model' => $model
        ]);
    }
}
?>
