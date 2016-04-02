<?php
namespace app\module\admin\controllers;

use yii;
use yii\data\ActiveDataProvider;

class UserController extends BaseController
{
    public function actionIndex()
    {
        $query = Yii::$app->userService->search();
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

    public function actionCreate()
    {

        return $this->render('update',[

        ]);
    }
}
?>
