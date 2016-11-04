<?php

use yii\bootstrap\Html;
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
            [
                'format' => 'html',
                'attribute' => 'bus_info_id',
                'value' => ($model->getBusInfo()->one() ? Html::a($model->getBusInfo()->one()->name, ['bus-info/view', 'id' => $model->getBusInfo()->one()->id,]) : '<span class="label label-warning">?</span>'),
            ],
            [
                'format' => 'html',
                'attribute' => 'bus_way_id',
                'value' => ($model->getBusWay()->one() ? Html::a($model->getBusWay()->one()->name, ['bus-way/view', 'id' => $model->getBusWay()->one()->id,]) : '<span class="label label-warning">?</span>'),
            ],
            'number_seat',
            'date',

            'status',
            'active:boolean',
            'person.name',
        ],
    ]) ?>

</div>
