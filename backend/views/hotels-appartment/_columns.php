<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class' => \kartik\grid\DataColumn::className(),
        'attribute' => 'hotels_info_id',
        'value' => function ($model) {
            if ($rel = $model->getHotelsInfo()->one()) {
                return Html::a($rel->name, ['hotels-info/view', 'id' => $rel->id,], ['data-pjax' => 0]);
            } else {
                return '';
            }
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\common\models\HotelsInfo::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Все гостиницы'],
        'format' => 'raw',
    ],
    [
        'class' => \kartik\grid\DataColumn::className(),
        'attribute' => 'hotels_appartment_item_id',
        'value' => function ($model) {
            if ($rel = $model->getHotelsAppartmentItem()->one()) {
                return Html::a($rel->name, ['hotels-appartment-item/view', 'id' => $rel->id,], ['data-pjax' => 0]);
            } else {
                return '';
            }
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\common\models\HotelsAppartmentItem::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Все типы номеров'],
        'format' => 'raw',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'price',
        'label' => Yii::t('app', 'Price to'),
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'date_add',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'date_edit',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id, $hotels_info_id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','View'),'data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item')], 
    ],

];   