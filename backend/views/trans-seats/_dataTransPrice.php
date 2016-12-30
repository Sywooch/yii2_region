<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->transPrices,
    'key' => 'id'
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    ['attribute' => 'id', 'visible' => false],
    [
        'attribute' => 'transInfo.name',
        'label' => Yii::t('app', 'Trans Info')
    ],
    'date_begin',
    'date_end',
    'price',
    'active',
    ['attribute' => 'lock', 'visible' => false],
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'trans-price'
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
