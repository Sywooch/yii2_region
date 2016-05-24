<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TourPrice */
?>
<div class="tour-price-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'price',
            'date',
            'active',
            'date_begin',
            'date_end',
            'tour_info_id',
            'in_hotels',
            'in_trans',
            'in_food',
        ],
    ]) ?>

</div>
