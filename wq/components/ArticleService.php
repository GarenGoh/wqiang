<?php
namespace app\components;

use app\models\Article;
use Yii;
use yii\base\Component;

class ArticleService extends Component
{
    public function search($where = [])
    {
        $query = Article::find();
        if(isset($where['id']) && $where['id']) {
            $query->andFilterWhere(['id' => $where['id']]);
        }
        return $query;
    }

    public function delete(Article $article)
    {
        return $article->delete();
    }

    public function save(Article $article, $attributes)
    {
        if($attributes) {
            $article->setAttributes($attributes,false);
            return $article->save();
        }
    }
}
?>
