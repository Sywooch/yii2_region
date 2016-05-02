<?php
use yii\helpers\Url;
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
        'attribute'=>'date_add',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date_edit',
    ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'active',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'begin_point',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'end_point',
    ],
    [
        'attribute'=>'editableTransStation',
        'vAlign' => 'middle',
        'width'=>'180px',
        'value'=>function ($model, $key, $index, $widget) {
            return Html::ul(\common\models\TransStation::getTransStationRelationField($model->id));
        },
        'filterType'=>\kartik\grid\GridView::FILTER_SELECT2,
        'filter'=>\common\models\TransStation::listAll(),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>Yii::t('app','Any station')],
        'format'=>'raw'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   