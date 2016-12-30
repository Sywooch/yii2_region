<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->transRouteHasTransStations,
    'key' => function ($model) {
        return ['trans_route_id' => $model->trans_route_id, 'trans_station_id' => $model->trans_station_id];
    }
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'transStation.name',
        'label' => Yii::t('app', 'Trans Station')
    ],
    'position',
    'active',
    ['attribute' => 'lock', 'visible' => false],
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'trans-route-has-trans-station'
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
