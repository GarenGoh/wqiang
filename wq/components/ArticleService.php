<?php
namespace app\components;

use app\helpers\Url;
use app\models\Article;
use Yii;
use yii\base\Component;

class ArticleService extends Component
{
    public function search($where = [])
    {
        $fields = ['id','category'];
        $query = Article::find();
        foreach($fields as $f) {
            if(isset($where[$f])) {
                $query->andFilterWhere([$f => $where[$f]]);
            }
        }

        if(!Url::isAdmin()) {
            $query->andWhere(['is_enable' => 1]);
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
        }
        
        return $article->save();
    }
}
?>
