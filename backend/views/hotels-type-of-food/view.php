<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsTypeOfFood */
?>
<div class="hotels-type-of-food-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'abbrev',
            'price',
            'type_price',
        ],
    ]) ?>

</div>
