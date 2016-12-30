<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->salBaskets,
    'key' => 'id'
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    ['attribute' => 'id', 'visible' => false],
    'date',
    [
        'attribute' => 'userinfo.username',
        'label' => Yii::t('app', 'Userinfo')
    ],
    [
        'attribute' => 'hotelsInfo.name',
        'label' => Yii::t('app', 'Hotels Info')
    ],
    [
        'attribute' => 'transInfo.name',
        'label' => Yii::t('app', 'Trans Info')
    ],
    'price',
    'col_day',
    'col_person',
    'col_kids',
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'sal-basket'
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
