<?php
use \yii\helpers\Url;

$this->title = "用户注册";
$this->params['pageId'] = 'user_register';
?>
<div style="margin: 60px 30%;">
    <div style="">
        <form style="" method="post" action="<?= Url::to(['site/register']) ?>">
            <input style="width: 100%" type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

            <div style="" class="col-md-12">
                <input
                    style="height: 45px;background-color: #EEE;border: none;width: 100%;margin-bottom: 18px;padding-left: 20px;border-radius: 5px;"
                    type="text" name="username" value="<?= $model->username ?>" required="true" placeholder="账号">
            </div>
            <div style="" class="col-md-12">
                <input
                    style="height: 45px;background-color: #EEE;border: none;width: 100%;margin-bottom: 18px;padding-left: 20px;border-radius: 5px;"
                    type="email" name="email" value="<?= $model->email ?>" required="true"
                    placeholder="邮箱">
            </div>
            <div style="" class="col-md-12">
                <input
                    style="height: 45px;background-color: #EEE;border: none;width: 100%;margin-bottom: 18px;padding-left: 20px;border-radius: 5px;"
                    type="password" name="password" value="<?= $model->password ?>"
                    required="true" placeholder="密码">
            </div>
            <div style="" class="col-md-12">
                <input
                    style="height: 45px;background-color: #EEE;border: none;width: 100%;margin-bottom: 18px;padding-left: 20px;border-radius: 5px;"
                    type="password" name="rePassword" value="<?= $model->rePassword ?>"
                    required="true" placeholder="确认密码">
            </div>
            <div style="" class="col-md-12">
                <input name="is_agree" type="checkbox" value="1" checked> 同意<a
                    href="<?= Url::to(['#']) ?>" target="_blank">《用户注册协议》</a>
            </div>
            <div style="" class="col-md-12" >
                <button
                    style="width: 100%;border: none;background-color: #c86cbe;height: 45px;border-radius: 5px;margin-bottom: 5px;margin-top: 5px;"
                    type="submit">提交
                </button>
            </div>
            <div style="margin-bottom: 100px" class="col-md-12">
                <a href="<?=Url::to(['site/login'])?>"><<返回登录</a>
            </div>

        </form>
    </div>
</div>
