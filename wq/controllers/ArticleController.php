<?php
namespace app\controllers;

use Yii;

class ArticleController extends BaseController
{
    public function actionPhp()
    {
        return $this->render('index',[
            'category' => 'php'
        ]);
    }
}
?>
