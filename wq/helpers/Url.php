<?php
namespace app\helpers;

use yii\helpers\Url as baseUrl;
use Yii;

class Url extends baseUrl
{
    /*
     * 生成一个表单的action；传送一个返回地址“return_url”。
     */
    public static function action()
    {
        $params = Yii::$app->request->get();
        $returnUrl = Yii::$app->request->get('return_url');
        unset($params['r'], $params['s']);

        if (!$returnUrl) {
            $params['return_url'] = Yii::$app->request->getReferrer();
        }

        $route = array_merge(['/'.Yii::$app->requestedRoute], $params);
        return Url::to($route);
    }
}
?>
