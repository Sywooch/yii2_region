<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsCharacterItem */
?>
<div class="hotels-character-item-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'value:ntext',
            'type',
            'hotels_character_id',
            'metrics:ntext',
        ],
    ]) ?>

</div>
