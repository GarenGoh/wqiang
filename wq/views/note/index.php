<?php

use yii\data\ActiveDataProvider;

$this->params['pageId'] = 'note-page';
$query = Yii::$app->noteService->search()
    ->orderBy(['weight' => SORT_DESC, 'id' => SORT_DESC]);
$provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 24
    ]
]);
$notes = $provider->getModels();
?>
<ul class="note-blocks">
    <?php
        foreach($notes as $n) {
    ?>
    <li>
        <?=$n->title?>
        <div class="popup">
            <p>
                <?=nl2br($n->content)?>
            </p>
        </div>
    </li>
    <?php }?>
</ul>
