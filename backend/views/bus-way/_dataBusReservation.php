<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->busReservations,
    'key' => function ($model) {
        return ['id' => $model->id, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id];
    }
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    ['attribute' => 'id', 'visible' => false],
    'name',
    [
        'attribute' => 'busInfo.name',
        'label' => Yii::t('app', 'Bus Info')
    ],
    'number_seat',
    'date',
    'status',
    'active',
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'bus-reservation'
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
