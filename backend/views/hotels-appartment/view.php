<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsAppartment */
?>
<div class="hotels-appartment-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hotels_info_id',
            'name:ntext',
            'price',
            'type_price',
        ],
    ]) ?>

</div>
