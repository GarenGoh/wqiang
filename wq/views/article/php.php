<?php
use yii\data\ActiveDataProvider;

$where = Yii::$app->request->get();
$where['is_enable'] = 1;
$query = Yii::$app->articleService->search($where)
    ->orderBy(['id' => SORT_DESC]);

$provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 8
    ]
]);
$article = $provider->getModels();
?>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
