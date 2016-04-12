<?php
namespace app\module\admin\controllers;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

abstract class BaseController extends Controller
{
    protected function success($message)
    {
        Yii::$app->session->setFlash('success_flash_message', $message);
    }

    protected function error($message)
    {
        Yii::$app->session->setFlash('error_flash_message', $message);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [User::ROLE_MANAGER]
                    ]
                ],
            ]
        ];
    }

    public function goBack($defaultUrl = null)
    {
        $returnUrl = Yii::$app->request->get('return_url', null);
        if ($returnUrl) {
            return Yii::$app->getResponse()->redirect($returnUrl);
        } else {
            return Yii::$app->getResponse()->redirect(Yii::$app->request->getReferrer());
        }
    }
}
