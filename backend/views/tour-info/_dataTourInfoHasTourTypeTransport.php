<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->tourInfoHasTourTypeTransports,
    'key' => function ($model) {
        return ['tour_info_id' => $model->tour_info_id, 'tour_type_transport_id' => $model->tour_type_transport_id];
    }
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'tourTypeTransport.name',
        'label' => Yii::t('app', 'Tour Type Transport')
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'tour-info-has-tour-type-transport'
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
