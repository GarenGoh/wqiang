<?php

use yii\helpers\Url;

$this->title = "用户登录";
$this->params['pageId'] = 'user_login';
?>
<div style="margin: 60px 30%;">
    <div style="">
        <form style="" method="post" action="<?= Url::to(['site/login']) ?>">
            <input style="width: 100%" type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

            <div style="" class="col-md-12">
                <input
                    style="height: 45px;background-color: #EEE;border: none;width: 100%;margin-bottom: 18px;padding-left: 20px;border-radius: 5px;"
                    type="text" name="account" value="<?= $model->account?>" required="true" placeholder="用户名/邮箱/手机">
            </div>
            <div style="" class="col-md-12">
                <input
                    style="height: 45px;background-color: #EEE;border: none;width: 100%;margin-bottom: 18px;padding-left: 20px;border-radius: 5px;"
                    type="password" name="password" value="<?= $model->password ?>"
                    required="true" placeholder="密码">
            </div>
            <div style="" class="col-md-12">
                <input name="is_remember" type="checkbox" value="1" checked> 30天内免登陆
            </div>
            <div style="" class="col-md-12" >
                <button
                    style="width: 100%;border: none;background-color: #c86cbe;height: 45px;border-radius: 5px;margin-bottom: 5px;margin-top: 5px;"
                    type="submit">提交
                </button>
            </div>
            <div style="margin-bottom: 100px" class="col-md-12">
                <a href="<?=Url::to(['site/register'])?>"><<返回注册</a>
            </div>

        </form>
    </div>
</div>
