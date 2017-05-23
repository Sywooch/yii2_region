<?php

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\bus\SearchSalOrder */
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
        ['attribute' => 'id', 'hidden' => true],
        'date',
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
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Sal order status'), 'id' => 'grid-search-sal-order-sal_order_status_id']
        ],
        'date_begin',
        'date_end',
        'enable',
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
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Hotels appartment'), 'id' => 'grid-search-sal-order-hotels_appartment_id']
        ],
        [
            'attribute' => 'trans_info_id',
            'label' => Yii::t('app', 'Trans Info'),
            'value' => function ($model) {
                return $model->transInfo->name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\TourTypeTransport::find()->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Tour type transport'), 'id' => 'grid-search-sal-order-trans_info_id']
        ],
        [
            'attribute' => 'user_id',
            'label' => Yii::t('app', 'Userinfo'),
            'value' => function ($model) {
                return $model->userinfo->username;
            },
            'filterType' => GridView::FILTER_SELECT2,
            //TODO Переделать на получение турагентов из таблицы AgentRekv
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->asArray()->all(), 'id', 'username'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Userinfo'), 'id' => 'grid-search-sal-order-user_id']
        ],
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
        'full_price',
        'insurance_info:ntext',
        'date_add',
        'date_edit',
        ['attribute' => 'lock', 'hidden' => true],
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
