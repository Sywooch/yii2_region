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
            'active:boolean',
            [
                'attribute' => 'busSchemeSeats.name',
                'label' => Yii::t('app', 'Bus Scheme Seats')
            ],
        ],
    ]) ?>

</div>
