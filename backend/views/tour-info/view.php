<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TourInfo */
?>
<div class="tour-info-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'date_begin',
            'date_end',
            'days',
            'tour_type_id',
            'toury_type_transport_id',
            'active',
        ],
    ]) ?>

</div>
