<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->busWays,
    'key' => 'id'
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    ['attribute' => 'id', 'visible' => false],
    'name:ntext',
    [
        'attribute' => 'busInfo.name',
        'label' => Yii::t('app', 'Bus Info')
    ],
    'date_begin',
    'date_end',
    'active',
    'ended',
    'path_time',
    'price',
    ['attribute' => 'lock', 'visible' => false],
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'bus-way'
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
