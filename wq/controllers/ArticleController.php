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

    public function actionLinux()
    {
        return $this->render('index',[
            'category' => Article::CATEGORY_LINUX
        ]);
    }

    public function actionDb()
    {
        return $this->render('index',[
            'category' => Article::CATEGORY_DB
        ]);
    }

    public function actionFrontend()
    {
        return $this->render('index',[
            'category' => Article::CATEGORY_FRONTEND
        ]);
    }

    public function actionLearn()
    {
        return $this->render('index',[
            'category' => Article::CATEGORY_LEARN
        ]);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $article = Yii::$app->articleService->search(['id' => $id])->one();
        $article->read_count++;
        $article->save();
        return $this->render('view', [
            'model' => $article
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
