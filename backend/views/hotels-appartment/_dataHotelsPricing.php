<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->hotelsPricings,
    'key' => 'id'
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    ['attribute' => 'id', 'visible' => false],
    [
        'attribute' => 'hotelsInfo.name',
        'label' => Yii::t('app', 'Hotels Info')
    ],
    //'hotels_info_id',
    [
        'attribute' => 'hotelsTypeOfFood.name',
        'label' => Yii::t('app', 'Hotels Type Of Food')
    ],
    //'date',
    'name:ntext',
    'active',
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'hotels-pricing'
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
