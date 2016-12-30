<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->tourInfoHasTourTypes,
    'key' => function ($model) {
        return ['tour_info_id' => $model->tour_info_id, 'tour_type_id' => $model->tour_type_id];
    }
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'tourType.name',
        'label' => Yii::t('app', 'Tour Type')
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'tour-info-has-tour-type'
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
