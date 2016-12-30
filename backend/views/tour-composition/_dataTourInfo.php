<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->tourInfos,
    'key' => 'id'
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    ['attribute' => 'id', 'visible' => false],
    'name:ntext',
    'date_begin',
    'date_end',
    'days',
    'active',
    [
        'attribute' => 'hotelsInfo.name',
        'label' => Yii::t('app', 'Hotels Info')
    ],
    [
        'attribute' => 'city.name',
        'label' => Yii::t('app', 'City')
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'tour-info'
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
