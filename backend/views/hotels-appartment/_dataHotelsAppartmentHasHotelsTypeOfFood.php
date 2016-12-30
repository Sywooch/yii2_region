<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->hotelsAppartmentHasHotelsTypeOfFoods,
    'key' => function ($model) {
        return ['id' => $model->id, 'hotels_info_id' => $model->hotels_info_id, 'hotels_type_of_food_id' => $model->hotels_type_of_food_id];
    }
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    /*[
        'attribute' => 'hotelsInfo.name',
        'label' => Yii::t('app', 'Hotels Info')
    ],*/
    //'hotels_info_id',
    [
        'attribute' => 'hotelsTypeOfFood.name',
        'label' => Yii::t('app', 'Hotels Type Of Food')
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'hotels-appartment-has-hotels-type-of-food'
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
