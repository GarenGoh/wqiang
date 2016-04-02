<?php

namespace app\models;

use app\helpers\Html;
use yii\validators\EmailValidator;
use \yii\web\IdentityInterface;
use Yii;

class User extends BaseActiveRecord implements IdentityInterface
{
    const ROLE_MEMBER = 0;
    const ROLE_MANAGER = 1;
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => '角色ID',
            'username' => '用户名',
            'password' => '密码',
            'password_hash' => '密码',
            'name' => '姓名',
            'email'  => '邮箱',
            'mobile' => '手机号码',
            'created_at' => '注册时间',
            'logged_at' => '最近登录',
            'is_enable' => '帐号可用',
            'avatar_url' => '头像Url',
            'avatar' => '头像'
        ];
    }

    private static $_mobilePattern = '/^1[3-9]{1}[0-9]{9}$/';

    public function rules()
    {
        $filterFields = [
            'password', 'name', 'email', 'mobile'
        ];
        return[
            [$filterFields, 'filter', 'filter'=>function($value) {
                return Html::encode(trim($value));//去除左右的空格，并将html标签转换为转义字符
            }],
            [['email', 'role_id'], 'required'],
            ['role_id', 'in', 'range' => [self::ROLE_MEMBER, self::ROLE_MANAGER]],
            ['email', 'filter', 'filter' => 'strtolower'],//转换为小写
            ['email', 'email', 'when' => function() {
                return !empty($this->email) && !$this->hasErrors();
            }],
            ['email', 'unique', 'when' => function() {//邮箱必须是独一无二的
                return !empty($this->email) && !$this->hasErrors();
            }],
            ['mobile', 'unique', 'when' => function() {//手机必须是独一无二的
                return !empty($this->mobile) && !$this->hasErrors();
            }],
            ['mobile', 'match', 'message' => '手机号格式不对！', 'pattern' => self::$_mobilePattern, 'when' => function() {
                return !empty($this->mobile) && !$this->hasErrors();//对比$_mobilePattern
            }],
            ['username', 'default', 'value' => function() {
                $username = 'yii_';
                $username .= isset($this->email) ? str_replace(array("@","."),"",$this->email) : rand(10000,99999);
                return $username;
            }],
            ['username', 'string', 'length' => [3,64], 'encoding' => 'utf-8'],
            ['username', 'unique', 'when' => function() {
                return !$this->hasErrors();
            }],
            ['mobile', 'unique', 'when' => function() {
                return !$this->hasErrors() && !empty($this->mobile);
            }],
            ['password', 'string', 'length' => [4,50], 'when' => function() {
                return $this->isNewRecord || !empty($this->password);
            }],
            ['is_enable', 'default', 'value' => self::BOOLEAN_YES],
            [['is_email_enable', 'is_mobile_enable'], 'default', 'value' => '0'],
            ['created_at', 'default', 'value' => time()]

        ];
    }


    /* IdentityInterface 实现开始 */

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::find()->andWhere(['id' => $id])->one();
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->andWhere(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        $key = 'Fuck the user ---> '.$this->id;
        return md5($key);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /* IdentityInterface 实现结束 */


    public function beforeSave($insert)
    {
        if (!$insert) {
            $this->role_id = $this->getOldAttribute('role_id');
        }

        if ($this->password) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        }

        return parent::beforeSave($insert);
    }

    public function findByAccount($account)
    {
        $attributeName = 'username';

        //如果符合手机好的样式，$attributeName = 'mobile'
        if (preg_match(self::$_mobilePattern, $account)) {
            $attributeName = 'mobile';
        }

        //验证是否是可用的邮箱，如果是，则$attributeName = 'email'
        $validator = new EmailValidator();
        if ($validator->validate($account, $error)) {
            $attributeName = 'email';
        }

        $where = [$attributeName => $account];

        return static::find()->andWhere($where)->one();
    }





}
