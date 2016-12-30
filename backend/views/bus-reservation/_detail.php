<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusReservation */

?>
<div class="bus-reservation-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name',
            [
                'attribute' => 'busInfo.name',
                'label' => Yii::t('app', 'Bus Info'),
            ],
            [
                'attribute' => 'busWay.name',
                'label' => Yii::t('app', 'Bus Way'),
            ],
            [
                'attribute' => 'person.id',
                'label' => Yii::t('app', 'Person'),
            ],
            'number_seat',
            'date',
            'status',
            'active',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>