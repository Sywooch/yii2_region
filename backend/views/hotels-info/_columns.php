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
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
        'vAlign'=>'middle',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'city_id',
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>/*function ($model, $key, $index, $widget) {
            return Html::a($model->country->name,
                '#',
                ['title'=>'Просмотр детальной информации', 'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")']);
        },*/
            function ($model) {
                if ($rel = $model->getCity()->one()) {
                    return Html::a($rel->name, ['city/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                } else {
                    return '';
                }
            },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\common\models\City::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Любой город'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'address',
        'vAlign'=>'middle',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'country',
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>/*function ($model, $key, $index, $widget) {
            return Html::a($model->country->name,
                '#',
                ['title'=>'Просмотр детальной информации', 'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")']);
        },*/
            function ($model) {
                if ($rel = $model->getCountry()->one()) {
                    return Html::a($rel->name, ['country/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                } else {
                    return '';
                }
            },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\common\models\Country::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Любая страна'],
        'format'=>'raw'
    ],
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'GPS',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'links_maps',
    ],*/
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hotels_stars_id',
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>/*function ($model, $key, $index, $widget) {
            return Html::a($model->country->name,
                '#',
                ['title'=>'Просмотр детальной информации', 'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")']);
        },*/function ($model) {
            if ($rel = $model->getHotelsStars()->one()) {
                return Html::a($rel->name, ['hotels-stars/view', 'id' => $rel->id,], ['data-pjax' => 0]);
            } else {
                return '';
            }
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\common\models\HotelsStars::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Все варианты'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'active',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'imageFiles',
        'width'=>'130px',
        'format' => 'html',
        'value' => function($model)
        {
            return Html::img($model->getImage()->getUrl('120x'));
        },
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