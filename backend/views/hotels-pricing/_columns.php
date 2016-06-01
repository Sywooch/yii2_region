<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hotels_appartment_id',
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>/*function ($model, $key, $index, $widget) {
            return Html::a($model->country->name,
                '#',
                ['title'=>'Просмотр детальной информации', 'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")']);
        },*/
            function ($model) {
                if ($rel = $model->getHotelsAppartment()->one()) {
                    return Html::a($rel->name, ['hotels-appartment/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                } else {
                    return '';
                }
            },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\common\models\HotelsAppartment::find()->andWhere(['active'=>1])->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Любой номер'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hotels_appartment_hotels_info_id',
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>/*function ($model, $key, $index, $widget) {
            return Html::a($model->country->name,
                '#',
                ['title'=>'Просмотр детальной информации', 'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")']);
        },*/
            function ($model) {
                if ($rel = $model->getHotelsInfo()->one()) {
                    return Html::a($rel->name, ['hotels-info/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                } else {
                    return '';
                }
            },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\common\models\HotelsInfo::find()->andWhere(['active'=>1])->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Любая гостиница'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hotels_others_pricing_id',
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>/*function ($model, $key, $index, $widget) {
            return Html::a($model->country->name,
                '#',
                ['title'=>'Просмотр детальной информации', 'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")']);
        },*/
            function ($model) {
                if ($rel = $model->getHotelsOthersPricing()->one()) {
                    return Html::a($rel->name, ['hotels-others-pricing/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                } else {
                    return '';
                }
            },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\common\models\HotelsOthersPricing::find()->andWhere(['active'=>1])->orderBy('price')->asArray()->all(), 'id', 'price'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Любые доп. цены'],
        'format'=>'raw'
    ],
    //[
        //'class'=>'\kartik\grid\DataColumn',
        //'attribute'=>'date',
    //],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'full_price',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'discount_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'date_begin',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'date_end',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hotels_type_of_food_id',
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>
            function ($model) {
                if ($rel = $model->getHotelsTypeOfFood()->one()) {
                    return Html::a($rel->name, ['hotels-type-of-food/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                } else {
                    return '';
                }
            },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\common\models\HotelsTypeOfFood::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Любой тип питания'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'active',
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
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