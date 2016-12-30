<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->busReservationHasPeople,
    'key' => function ($model) {
        return ['bus_reservation_id' => $model->bus_reservation_id, 'person_id' => $model->person_id];
    }
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'person.id',
        'label' => Yii::t('app', 'Person'),

    ],
    'number_seats',
    ['attribute' => 'lock', 'visible' => false],
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'bus-reservation-has-person'
    ],
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'containerOptions' => ['style' => 'overflow: auto'],
    'pjax' => true,
    'beforeHeader' => [
        [
            'options' => ['class' => 'skip-export']
        ]
    ],
    'export' => [
        'fontAwesome' => true
    ],
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'showPageSummary' => false,
    'persistResize' => false,
]);
