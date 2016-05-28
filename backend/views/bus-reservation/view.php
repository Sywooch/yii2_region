<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusReservation */
?>
<div class="bus-reservation-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'bus_info_id',
            'bus_way_id',
            'number_seat',
            'date',
            'status',
            'active',
            'persons_id',
        ],
    ]) ?>

</div>
