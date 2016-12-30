<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->salOrders,
    'key' => 'id'
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    ['attribute' => 'id', 'visible' => false],
    'date',
    [
        'attribute' => 'salOrderStatus.name',
        'label' => Yii::t('app', 'Sal Order Status')
    ],
    'date_begin',
    'date_end',
    'enable',
    [
        'attribute' => 'hotelsInfo.name',
        'label' => Yii::t('app', 'Hotels Info')
    ],
    [
        'attribute' => 'transInfo.name',
        'label' => Yii::t('app', 'Trans Info')
    ],
    [
        'attribute' => 'hotelsTypeOfFood.name',
        'label' => Yii::t('app', 'Hotels Type Of Food')
    ],
    [
        'attribute' => 'userinfo.username',
        'label' => Yii::t('app', 'Userinfo')
    ],
    [
        'attribute' => 'tourInfo.name',
        'label' => Yii::t('app', 'Tour Info')
    ],
    'full_price',
    'insurance_info:ntext',
    ['attribute' => 'lock', 'visible' => false],
    'hotels_appartment_full_sale',
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'sal-order'
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
