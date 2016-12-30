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
        'attribute' => 'busRoutePoint.name',
        'label' => Yii::t('app', 'Bus Route Point')
    ],
    'first_point:boolean',
    'end_point:boolean',
    'position',
    'date_point_forward',
    'time_pause:ntext',
    'date_point_reverse',
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
