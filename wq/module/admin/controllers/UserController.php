<?php
namespace app\module\admin\controllers;

use app\models\User;
use yii;
use yii\data\ActiveDataProvider;

class UserController extends BaseController
{
    public function behaviors()
    {
        return yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ]
            ],
        ]);
    }

    public function loadUser()
    {
        $userId = yii::$app->request->getQueryParam('id');
        if($userId) {
        $user = yii::$app->userService->search(['id' => $userId])->one();
            if($user) {
                return $user;
            }else{
                $this->error('无此用户！');
                $this->goBack();
            }
        }else{
            $this->error('缺少参数id');
            return $this->goBack();
        }
    }

    public function actionIndex()
    {
        $sort = Yii::$app->request->get('sort');
        $orderBy = $this->sort($sort);
        $query = Yii::$app->userService->search()
            ->orderBy($orderBy);
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

    public function actionDelete()
    {
        $user = $this->loadUser();

        $result = yii::$app->userService->delete($user);
        if($result) {
            $this->success('删除成功！');
            $this->goBack();
        }else{
            $this->error('删除失败！');
            $this->goBack();
        }
    }

    public function actionCreate()
    {
        $user = new User();
        if($attributes = Yii::$app->request->post('User')) {
            $result = Yii::$app->userService->save($user,$attributes);
            if($result) {
                $this->success('用户信息更改成功！');
                $this->goBack();
            }else{
                $this->error('用户信息更改失败！');
                $this->goBack();
            }
        }
        return $this->render('update',[
            'model' => $user
        ]);
    }

    public function actionUpdate()
    {
        $user = $this->loadUser();

        if($attributes = Yii::$app->request->post('User')) {
            $result = Yii::$app->userService->save($user,$attributes);
            if($result) {
                $this->success('用户信息更改成功！');
                $this->goBack();
            }else{
                $this->error('用户信息更改失败！');
                $this->goBack();
            }
        }

        return $this->render('update',[
            'model' => $user
        ]);
    }
}
?>
