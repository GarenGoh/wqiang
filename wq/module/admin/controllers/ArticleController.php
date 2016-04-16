<?php
namespace app\module\admin\controllers;

use Yii;
use yii\data\ActiveDataProvider;

class ArticleController extends BaseController
{
    public function actionIndex()
    {
        $query = Yii::$app->articleService->search();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50
            ]
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
}
?>
