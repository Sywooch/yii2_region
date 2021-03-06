<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->busRouteHasBusRoutePoints,
    'key' => function ($model) {
        return ['bus_route_id' => $model->bus_route_id, 'bus_route_point_id' => $model->bus_route_point_id];
    }
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'busRoute.name',
        'label' => Yii::t('app', 'Bus Route')
    ],
    'first_point',
    'end_point',
    'position',
    'date_point_forward',
    'time_pause:datetime',
    'date_point_reverse',
    'date_add',
    'date_edit',
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'bus-route-has-bus-route-point'
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
