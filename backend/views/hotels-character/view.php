<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsCharacter */
?>
<div class="hotels-character-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'parent_id',
            'num_hierar',
            'date_add',
            'date_edit',
            'active',
        ],
    ]) ?>

</div>
