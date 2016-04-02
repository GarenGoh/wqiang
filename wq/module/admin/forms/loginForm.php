<?php
namespace app\module\admin\forms;

use yii\base\Model;
use Yii;
use app\models\User;

class LoginForm extends Model
{
    public $account;
    public $password;
    public $is_remember = true;

    public $_user = false;

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->userService->login($this->getUser());
        } else {
            return false;
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByAccount($this->account);
        }
        return $this->_user;
    }
}
?>
