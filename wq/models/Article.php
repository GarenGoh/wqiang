<?php
namespace app\models;

use Yii;

class Article extends BaseActiveRecord
{
    const CATEGORY_PHP = 0;
    const CATEGORY_FRONTEND = 1;
    const CATEGORY_JS = 2;

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
            'category_id' => '分类ID',
            'category' => '分类',
            'keywords' => '关键词',
            'summary' => '简介',
            'read_count' => '阅读数',
            'is_hot' => '是否热点',
        ];
    }

    public static function getCategoryMap($status = null)
    {

        $map = [
            static::CATEGORY_PHP => 'PHP',
            static::CATEGORY_FRONTEND => '前端',
            static::CATEGORY_JS => 'JavaScript',
        ];
        return !is_null($status) && $map[$status] ? $map[$status] : $map;
    }

    public function rules()
    {
        return [
            [['category_id', 'is_hot', 'read_count'], 'default', 'value' => 0],
            [['is_enable'], 'default', 'value' => 1],
            [['title'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 200],
            [['keywords'], 'string', 'max' => 100],
            ['created_at', 'default', 'value' => time()],
            ['creator_id', 'default', 'value' => Yii::$app->userService->getId()]
        ];
    }
}
?>
