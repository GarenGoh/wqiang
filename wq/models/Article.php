<?php
namespace app\models;

use Yii;
use yii\helpers\Url;

class Article extends BaseActiveRecord
{
    const CATEGORY_PHP = "php";
    const CATEGORY_LINUX = "linux";
    const CATEGORY_DB = "db";
    const CATEGORY_FRONTEND = "frontend";
    const CATEGORY_LEARN = "learn";

    public static function tableName()
    {
        return '{{%article}}';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'is_enable' => '是否可用',
            'created_at' => '创建时间',
            'creator_id' => '创建者',
            'content' => '内容',
            'category' => '分类',
            'keywords' => '关键词',
            'summary' => '简介',
            'read_count' => '阅读数',
            'is_hot' => '是否热点',
            'image_id' => '封面ID',
            'image' => '封面',
        ];
    }

    public static function getCategoryMap($status = null)
    {

        $map = [
            static::CATEGORY_PHP => 'PHP',
            static::CATEGORY_LINUX => 'Linux',
            static::CATEGORY_DB => '数据库',
            static::CATEGORY_FRONTEND => '前端',
            static::CATEGORY_LEARN => '学无止境'
        ];
        return !is_null($status) && $map[$status] ? $map[$status] : $map;
    }

    public function rules()
    {
        return [
            [['is_hot', 'read_count'], 'default', 'value' => 0],
            ['category', 'default', 'value' => static::CATEGORY_LEARN],
            [['is_enable'], 'default', 'value' => 1],
            [['title'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 200],
            [['keywords'], 'string', 'max' => 100],
            ['created_at', 'default', 'value' => time()],
            ['creator_id', 'default', 'value' => Yii::$app->userService->getId()]
        ];
    }

    public function getImageUrl()
    {
        $file = Yii::$app->fileService->search(['id' => $this->image_id])->one();

        return $file->url;
    }

    public function getUrl()
    {
        return Url::to(['article/view', 'id' => $this->id]);
    }
}
?>
