<?php

namespace app\controllers;

use Yii;
use app\forms\LoginForm;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\forms\RegisterForm;

class SiteController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        if (Yii::$app->request->isPost) {
            $attributes = Yii::$app->request->getBodyParams();
            $model->setAttributes($attributes);

            if ($model->submit()) {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['status' => true];
                } else {
                    $this->success('帐号注册成功！');
                    return $this->goBack();
                }
            } else {
                $message = $model->getFirstError();
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    Yii::$app->response->statusCode = 400;
                    return ['status' => false, 'message' => $message];
                }
                $this->error($message);
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if (Yii::$app->request->isPost) {
            $model->setAttributes(Yii::$app->request->post());
            if ($model->submit()) {
                return $this->goBack();
            } else {
                $message = $model->getFirstError();
                $this->error($message);
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    /*public function actionTest()
    {
        Yii::$app->fileService->save();

        return $this->goHome();
    }*/
}
