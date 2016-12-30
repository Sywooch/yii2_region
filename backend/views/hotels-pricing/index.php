<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchHotelsPricing */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Hotels Pricings');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="hotels-pricing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Hotels Pricing'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'hotels_appartment_id',
            'label' => Yii::t('app', 'Hotels Appartment'),
            'value' => function ($model) {
                return $model->hotelsAppartment->name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\HotelsAppartment::find()->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                ],
            'filterInputOptions' => ['placeholder' => 'Hotels appartment', 'id' => 'grid-search-hotels-pricing-hotels_appartment_id']
        ],
        [
            'attribute' => 'hotels_info_id',
            'label' => Yii::t('app', 'Hotels Info'),
            'value' => function ($model) {
                return $model->hotelsInfo->name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::find()->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                ],
            'filterInputOptions' => ['placeholder' => 'Hotels info', 'id' => 'grid-search-hotels-pricing-hotels_info_id']
        ],
        [
            'attribute' => 'hotels_type_of_food_id',
            'label' => Yii::t('app', 'Hotels Type Of Food'),
            'value' => function ($model) {
                return $model->hotelsTypeOfFood->name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\HotelsTypeOfFood::find()->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                ],
            'filterInputOptions' => ['placeholder' => 'Hotels type of food', 'id' => 'grid-search-hotels-pricing-hotels_type_of_food_id']
        ],
        'name:ntext',
        'active',
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{save-as-new} {view} {update} {delete}',
            'buttons' => [
                'save-as-new' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
                },
            ],
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-hotels-pricing']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]),
        ],
    ]); ?>

</div>
