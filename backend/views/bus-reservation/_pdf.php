<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusReservation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Reservations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-reservation-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Bus Reservation') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name',
            [
                'attribute' => 'busInfo.name',
                'label' => Yii::t('app', 'Bus Info')
            ],
            [
                'attribute' => 'busWay.name',
                'label' => Yii::t('app', 'Bus Way')
            ],
            [
                'attribute' => 'person.id',
                'label' => Yii::t('app', 'Person')
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

    <div class="row">
        <?php
        if ($providerBusReservationHasPerson->totalCount) {
            $gridColumnBusReservationHasPerson = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'person.id',
                    'label' => Yii::t('app', 'Person')
                ],
                'number_seats',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerBusReservationHasPerson,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Bus Reservation Has Person')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnBusReservationHasPerson
            ]);
        }
        ?>
    </div>
</div>
