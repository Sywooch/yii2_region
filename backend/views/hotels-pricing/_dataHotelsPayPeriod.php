<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->hotelsPayPeriods,
    'key' => 'id'
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    ['attribute' => 'id', 'visible' => false],
    'date_begin',
    'date_end',
    'active',
    'price',
    ['attribute' => 'lock', 'visible' => false],
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'hotels-pay-period'
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
