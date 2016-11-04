<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchSalOrder */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Sal Orders');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
$colorPluginOptions = [
    'showPalette' => true,
    'showPaletteOnly' => true,
    'showSelectionPalette' => true,
    'showAlpha' => false,
    'allowEmpty' => false,
    'preferredFormat' => 'color',
    'palette' => [
        [
            "white", "black", "grey", "silver", "gold", "brown",
        ],
        [
            "red", "orange", "yellow", "indigo", "maroon", "pink"
        ],
        [
            "blue", "green", "violet", "cyan", "magenta", "purple",
        ],
    ]
];
?>
<div class="sal-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sal Order'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'attribute' => 'tour_info_id',
            'label' => Yii::t('app', 'Tour Info'),
            'value' => function ($model) {
                return $model->tourInfo->name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\TourInfo::find()->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Tour info'), 'id' => 'grid-search-sal-order-tour_info_id']
        ],
        [
            'attribute' => 'full_price',
            'label' => Yii::t('app', 'Price'),
        ],
        [
            'attribute' => 'sal_order_status_id',
            'label' => Yii::t('app', 'Sal Order Status'),
            'value' => function ($model) {
                return $model->salOrderStatus->name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\SalOrderStatus::find()->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Status'), 'id' => 'grid-search-sal-order-sal_order_status_id']
            ],
        [
            //'attribute' => ['date_begin'],
            'label' => Yii::t('app', 'Sal tour date'),
            'value' => function ($model) {
                return $model->date_begin . ' - ' . $model->date_end;
            },
        ],
        [
            'attribute' => 'enable',
            'class' => '\kartik\grid\BooleanColumn',
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
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Hotels info'), 'id' => 'grid-search-sal-order-hotels_info_id']
            ],
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
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Hotels Appartment'), 'id' => 'grid-search-sal-order-hotels_appartment_id']
            ],
        [
            'attribute' => 'trans_info_id',
            'label' => Yii::t('app', 'Sal Trans Info'),
            'value' => function ($model) {
                if (isset($model->transInfo->name)) {
                    return $model->transInfo->name;
                }
                return false;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\TourTypeTransport::find()->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Sal Trans Info'), 'id' => 'grid-search-sal-order-trans_info_id']
            ],
        /*[
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
            'filterInputOptions' => ['placeholder' => Yii::t('app','Hotels type of food'), 'id' => 'grid-search-sal-order-hotels_type_of_food_id']
        ],*/
        [
            'attribute' => 'userinfo_id',
            'label' => Yii::t('app', 'Userinfo'),
            'value' => function ($model) {
                return $model->userinfo->username;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Userinfo::find()->asArray()->all(), 'id', 'username'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Userinfo'), 'id' => 'grid-search-sal-order-userinfo_id']
            ],


        //'insurance_info:ntext',
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sal-order']],
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
