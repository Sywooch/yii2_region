<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\detail\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var common\models\HotelsInfo $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('app', 'HotelsInfo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'HotelsInfos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');

$items = $model->getImage2amigos(true);
?>
<div class="giiant-crud hotels-info-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('app', 'HotelsInfo') ?>
        <small>
            <?= $model->name ?>        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Edit'),
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-info']) ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('app', 'Copy'),
                ['create', 'id' => $model->id, 'HotelsInfo' => $copyParams],
                ['class' => 'btn btn-success']) ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'),
                ['create'],
                ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . Yii::t('app', 'Full list'), ['index'], ['class' => 'btn btn-default']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('common\models\HotelsInfo'); ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            [
                'format' => 'html',
                'attribute' => 'description',
            ],
            'address:ntext',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::attributeFormat
            [
                'format' => 'html',
                'attribute' => 'country',
                'value' => ($model->getCountry()->one() ? Html::a($model->getCountry()->one()->name, ['country/view', 'id' => $model->getCountry()->one()->id,]) : '<span class="label label-warning">?</span>'),
            ],
            'gps_point_m',
            'gps_point_p',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::attributeFormat
            [
                'format' => 'html',
                'attribute' => 'hotels_stars_id',
                'value' => ($model->getHotelsStars()->one() ? Html::a($model->getHotelsStars()->one()->name, ['hotels-stars/view', 'id' => $model->getHotelsStars()->one()->id,]) : '<span class="label label-warning">?</span>'),
            ],
            'date_add',
            'date_edit',
            [
                'attribute' => 'active',
                'type' => DetailView::INPUT_SWITCH,
                'format'=>'raw',
                'value'=>$model->active ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>',
                'type'=>DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => 'Да',
                        'offText' => 'Нет',
                    ]
                ],
            ],
            [
                'attribute' => 'top',
                'type' => DetailView::INPUT_SWITCH,
                'format'=>'raw',
                'value'=>$model->active ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>',
                'type'=>DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => 'Да',
                        'offText' => 'Нет',
                    ]
                ],
            ],
        ],
    ]); ?>

    <?= \dosamigos\gallery\Gallery::widget(['items' => $items,
        'options' => [
            'class' => 'row',
        ],
    ]); ?>


    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data-confirm' => '' . Yii::t('app', 'Are you sure to delete this item?') . '',
            'data-method' => 'post',
        ]); ?>
    <?php $this->endBlock(); ?>



    <?php $this->beginBlock('Discounts'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Discounts',
                ['discount/index'],
                ['class' => 'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Discount',
                ['discount/create', 'Discount' => ['hotels_info_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            ); ?>
        </div>
    </div><?php Pjax::begin(['id' => 'pjax-Discounts', 'enableReplaceState' => false, 'linkSelector' => '#pjax-Discounts ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    <?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getDiscounts(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-discounts']]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Yii::t('app', 'First'),
            'lastPageLabel' => Yii::t('app', 'Last')
        ],
        'columns' => [[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}',
            'contentOptions' => ['nowrap' => 'nowrap'],
            'urlCreator' => function ($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                $params[0] = 'discount' . '/' . $action;
                return $params;
            },
            'buttons' => [

            ],
            'controller' => 'discount'
        ],
            'id',
            'name:ntext',
            'discount',
            'type_price',
            'date_begin',
            'date_end',
            'active',
        ]
    ]) . '</div>' ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('HotelsAppartments'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Hotels Appartments',
                ['hotels-appartment/index'],
                ['class' => 'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Hotels Appartment',
                ['hotels-appartment/create', 'HotelsAppartment' => ['hotels_info_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            ); ?>
        </div>
    </div><?php Pjax::begin(['id' => 'pjax-HotelsAppartments', 'enableReplaceState' => false, 'linkSelector' => '#pjax-HotelsAppartments ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    <?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getHotelsAppartments(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-hotelsappartments']]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Yii::t('app', 'First'),
            'lastPageLabel' => Yii::t('app', 'Last')
        ],
        'columns' => [[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}',
            'contentOptions' => ['nowrap' => 'nowrap'],
            'urlCreator' => function ($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                $params[0] = 'hotels-appartment' . '/' . $action;
                return $params;
            },
            'buttons' => [

            ],
            'controller' => 'hotels-appartment'
        ],
            'id',
            'name:ntext',
            'price',
            'type_price',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'hotels_appartment_item_id',
                'value' => function ($model) {
                    if ($rel = $model->getHotelsAppartmentItem()->one()) {
                        return Html::a($rel->name, ['hotels-appartment-item/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            'date_add',
            'date_edit',
            'active',
        ]
    ]) . '</div>' ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('HotelsCharacterItems'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Hotels Character Items',
                ['hotels-character-item/index'],
                ['class' => 'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Hotels Character Item',
                ['hotels-character-item/create', 'HotelsCharacterItem' => ['hotels_info_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            ); ?>
        </div>
    </div><?php Pjax::begin(['id' => 'pjax-HotelsCharacterItems', 'enableReplaceState' => false, 'linkSelector' => '#pjax-HotelsCharacterItems ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    <?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getHotelsCharacterItems(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-hotelscharacteritems']]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Yii::t('app', 'First'),
            'lastPageLabel' => Yii::t('app', 'Last')
        ],
        'columns' => [[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}',
            'contentOptions' => ['nowrap' => 'nowrap'],
            'urlCreator' => function ($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                $params[0] = 'hotels-character-item' . '/' . $action;
                return $params;
            },
            'buttons' => [

            ],
            'controller' => 'hotels-character-item'
        ],
            'id',
            'value:ntext',
            'type',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'hotels_character_id',
                'value' => function ($model) {
                    if ($rel = $model->getHotelsCharacter()->one()) {
                        return Html::a($rel->name, ['hotels-character/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            'metrics:ntext',
            'date_add',
            'date_edit',
            'active',
        ]
    ]) . '</div>' ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('TourInfos'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Tour Infos',
                ['tour-info/index'],
                ['class' => 'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Tour Info',
                ['tour-info/create', 'TourInfo' => ['id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            ); ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-link"></span> ' . Yii::t('app', 'Attach') . ' Tour Info', ['hotels-info-has-tour-info/create', 'HotelsInfoHasTourInfo' => ['hotels_info_id' => $model->id]],
                ['class' => 'btn btn-info btn-xs']
            ) ?>
        </div>
    </div><?php Pjax::begin(['id' => 'pjax-TourInfos', 'enableReplaceState' => false, 'linkSelector' => '#pjax-TourInfos ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    <?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getHotelsInfoHasTourInfos(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-hotelsinfohastourinfos']]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Yii::t('app', 'First'),
            'lastPageLabel' => Yii::t('app', 'Last')
        ],
        'columns' => [[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete}',
            'contentOptions' => ['nowrap' => 'nowrap'],
            'urlCreator' => function ($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                $params[0] = 'hotels-info-has-tour-info' . '/' . $action;
                return $params;
            },
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                        'class' => 'text-danger',
                        'title' => Yii::t('app', 'Remove'),
                        'data-confirm' => Yii::t('app', 'Are you sure you want to delete the related item?'),
                        'data-method' => 'post',
                        'data-pjax' => '0',
                    ]);
                },
                'view' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-cog"></span>',
                        $url,
                        [
                            'data-title' => Yii::t('app', 'View Pivot Record'),
                            'data-toggle' => 'tooltip',
                            'data-pjax' => '0',
                            'class' => 'text-muted',
                        ]
                    );
                },
            ],
            'controller' => 'hotels-info-has-tour-info'
        ],
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'tour_info_id',
                'value' => function ($model) {
                    if ($rel = $model->getTourInfo()->one()) {
                        return Html::a($rel->name, ['tour-info/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
        ]
    ]) . '</div>' ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('HotelsOthersPricings'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Hotels Others Pricings',
                ['hotels-others-pricing/index'],
                ['class' => 'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Hotels Others Pricing',
                ['hotels-others-pricing/create', 'HotelsOthersPricing' => ['hotels_info_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            ); ?>
        </div>
    </div><?php Pjax::begin(['id' => 'pjax-HotelsOthersPricings', 'enableReplaceState' => false, 'linkSelector' => '#pjax-HotelsOthersPricings ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    <?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getHotelsOthersPricings(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-hotelsotherspricings']]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Yii::t('app', 'First'),
            'lastPageLabel' => Yii::t('app', 'Last')
        ],
        'columns' => [[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}',
            'contentOptions' => ['nowrap' => 'nowrap'],
            'urlCreator' => function ($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                $params[0] = 'hotels-others-pricing' . '/' . $action;
                return $params;
            },
            'buttons' => [

            ],
            'controller' => 'hotels-others-pricing'
        ],
            'id',
            'price',
            'type_price',
            'active',
            'date_begin',
            'date_end',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'hotels_others_pricing_type_id',
                'value' => function ($model) {
                    if ($rel = $model->getHotelsOthersPricingType()->one()) {
                        return Html::a($rel->name, ['hotels-others-pricing-type/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
        ]
    ]) . '</div>' ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('SalBaskets'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Sal Baskets',
                ['sal-basket/index'],
                ['class' => 'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Sal Basket',
                ['sal-basket/create', 'SalBasket' => ['hotels_info_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            ); ?>
        </div>
    </div><?php Pjax::begin(['id' => 'pjax-SalBaskets', 'enableReplaceState' => false, 'linkSelector' => '#pjax-SalBaskets ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    <?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getSalBaskets(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-salbaskets']]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Yii::t('app', 'First'),
            'lastPageLabel' => Yii::t('app', 'Last')
        ],
        'columns' => [[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}',
            'contentOptions' => ['nowrap' => 'nowrap'],
            'urlCreator' => function ($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                $params[0] = 'sal-basket' . '/' . $action;
                return $params;
            },
            'buttons' => [

            ],
            'controller' => 'sal-basket'
        ],
            'id',
            'date',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'userinfo_id',
                'value' => function ($model) {
                    if ($rel = $model->getUserinfo()->one()) {
                        return Html::a($rel->id, ['userinfo/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'tour_info_id',
                'value' => function ($model) {
                    if ($rel = $model->getTourInfo()->one()) {
                        return Html::a($rel->name, ['tour-info/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'trans_info_id',
                'value' => function ($model) {
                    if ($rel = $model->getTransInfo()->one()) {
                        return Html::a($rel->name, ['trans-info/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            'price',
            'col_day',
            'col_person',
            'col_kids',
        ]
    ]) . '</div>' ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('SalOrders'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Sal Orders',
                ['sal-order/index'],
                ['class' => 'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Sal Order',
                ['sal-order/create', 'SalOrder' => ['hotels_info_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            ); ?>
        </div>
    </div><?php Pjax::begin(['id' => 'pjax-SalOrders', 'enableReplaceState' => false, 'linkSelector' => '#pjax-SalOrders ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    <?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getSalOrders(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-salorders']]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Yii::t('app', 'First'),
            'lastPageLabel' => Yii::t('app', 'Last')
        ],
        'columns' => [[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}',
            'contentOptions' => ['nowrap' => 'nowrap'],
            'urlCreator' => function ($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                $params[0] = 'sal-order' . '/' . $action;
                return $params;
            },
            'buttons' => [

            ],
            'controller' => 'sal-order'
        ],
            'id',
            'date',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'sal_order_status_id',
                'value' => function ($model) {
                    if ($rel = $model->getSalOrderStatus()->one()) {
                        return Html::a($rel->name, ['sal-order-status/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            'hotels_info',
            'transport_info',
            'persons',
            'child',
            'date_begin',
            'date_end',
        ]
    ]) . '</div>' ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?= Tabs::widget(
        [
            'id' => 'relation-tabs',
            'encodeLabels' => false,
            'items' => [[
                'label' => '<b class=""># ' . $model->id . '</b>',
                'content' => $this->blocks['common\models\HotelsInfo'],
                'active' => true,
            ], [
                'content' => $this->blocks['Discounts'],
                'label' => '<small>Discounts <span class="badge badge-default">' . count($model->getDiscounts()->asArray()->all()) . '</span></small>',
                'active' => false,
            ], [
                'content' => $this->blocks['HotelsAppartments'],
                'label' => '<small>Hotels Appartments <span class="badge badge-default">' . count($model->getHotelsAppartments()->asArray()->all()) . '</span></small>',
                'active' => false,
            ], [
                'content' => $this->blocks['HotelsCharacterItems'],
                'label' => '<small>Hotels Character Items <span class="badge badge-default">' . count($model->getHotelsCharacterItems()->asArray()->all()) . '</span></small>',
                'active' => false,
            ], [
                'content' => $this->blocks['TourInfos'],
                'label' => '<small>Tour Infos <span class="badge badge-default">' . count($model->getTourInfos()->asArray()->all()) . '</span></small>',
                'active' => false,
            ], [
                'content' => $this->blocks['HotelsOthersPricings'],
                'label' => '<small>Hotels Others Pricings <span class="badge badge-default">' . count($model->getHotelsOthersPricings()->asArray()->all()) . '</span></small>',
                'active' => false,
            ], [
                'content' => $this->blocks['SalBaskets'],
                'label' => '<small>Sal Baskets <span class="badge badge-default">' . count($model->getSalBaskets()->asArray()->all()) . '</span></small>',
                'active' => false,
            ], [
                'content' => $this->blocks['SalOrders'],
                'label' => '<small>Sal Orders <span class="badge badge-default">' . count($model->getSalOrders()->asArray()->all()) . '</span></small>',
                'active' => false,
            ],]
        ]
    );
    ?>
</div>
