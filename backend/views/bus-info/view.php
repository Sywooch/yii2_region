<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusInfo */
?>
<div class="bus-info-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name:ntext',
            'gos_number',
            'seat',
            'date',
            'active',
            'bus_scheme_seats_id',
        ],
    ]) ?>

</div>
