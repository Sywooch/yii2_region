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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Bus Reservation') . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'),
                ['pdf', 'id' => $model->id, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            ) ?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id], ['class' => 'btn btn-info']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
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
                'attribute' => 'person.lastname',
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

    <div class="row">
        <?php
        if ($providerBusReservationHasPerson->totalCount) {
            $gridColumnBusReservationHasPerson = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'person.id',
                    'label' => Yii::t('app', 'Person'),
                    'value' => function ($model) {
                        return \common\models\BusReservation::getPersonFullName($model->person->id)[$model->person->id];
                    },
                ],
                'number_seats',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerBusReservationHasPerson,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-bus-reservation-has-person']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Bus Reservation Has Person')),
                ],
                'columns' => $gridColumnBusReservationHasPerson
            ]);
        }
        ?>
    </div>
</div>
