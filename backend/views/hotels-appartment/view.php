<?php

use dmstr\bootstrap\Tabs;
use dmstr\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var common\models\HotelsAppartment $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('app', 'HotelsAppartment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'HotelsAppartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');

$items = $model->getImage2amigos(true);
?>
<div class="giiant-crud hotels-appartment-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('app', 'HotelsAppartment') ?>        <small>
            <?= $model->name ?>        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a(
            '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Edit'),
            [ 'update', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id],
            ['class' => 'btn btn-info']) ?>

            <?= Html::a(
            '<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('app', 'Copy'),
            ['create', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id, 'HotelsAppartment'=>$copyParams],
            ['class' => 'btn btn-success']) ?>

            <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'),
            ['create'],
            ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
            . Yii::t('app', 'Full list'), ['index'], ['class'=>'btn btn-default']) ?>
        </div>

    </div>

    <hr />

    <?php $this->beginBlock('common\models\HotelsAppartment'); ?>

    
    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::attributeFormat
        [
            'format' => 'html',
            'attribute' => 'hotels_info_id',
            'value' => ($model->getHotelsInfo()->one() ? Html::a($model->getHotelsInfo()->one()->name, ['hotels-info/view', 'id' => $model->getHotelsInfo()->one()->id,]) : '<span class="label label-warning">?</span>'),
        ],
        'name:ntext',
        'price',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::attributeFormat
        [
            'format' => 'html',
            'attribute' => 'hotels_appartment_item_id',
            'value' => ($model->getHotelsAppartmentItem()->one() ? Html::a($model->getHotelsAppartmentItem()->one()->name, ['hotels-appartment-item/view', 'id' => $model->getHotelsAppartmentItem()->one()->id,]) : '<span class="label label-warning">?</span>'),
        ],
        'date_add',
        'date_edit',
        'active',
        'count_rooms',
        'count_beds',
        [
            'format' => 'html',
            'attribute' => 'created_by',
            'value' => ($model->created_by ? \common\models\Userinfo::findOne(['id' => $model->created_by])->username : '<span class="label label-warning">?</span>'),
        ],
        [
            'format' => 'html',
            'attribute' => 'updated_by',
            'value' => ($model->updated_by ? \common\models\Userinfo::findOne(['id' => $model->updated_by])->username : '<span class="label label-warning">?</span>'),
        ],
    ],
    ]); ?>
    <?= \dosamigos\gallery\Gallery::widget(['items' => $items,
        'options' => [
            'class' => 'row',
        ],
    ]); ?>

    
    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => '' . Yii::t('app', 'Are you sure to delete this item?') . '',
    'data-method' => 'post',
    ]); ?>
    <?php $this->endBlock(); ?>


    
<?php $this->beginBlock('HotelsAppartmentHasHotelsTypeOfFoods'); ?>
<div style='position: relative'><div style='position:absolute; right: 0px; top: 0px;'>
  <?= Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Hotels Appartment Has Hotels Type Of Foods',
            ['hotels-appartment-has-hotels-type-of-food/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Hotels Appartment Has Hotels Type Of Food',
            ['hotels-appartment-has-hotels-type-of-food/create', 'HotelsAppartmentHasHotelsTypeOfFood' => ['id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</div></div><?php Pjax::begin(['id'=>'pjax-HotelsAppartmentHasHotelsTypeOfFoods', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-HotelsAppartmentHasHotelsTypeOfFoods ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
    'layout' => '{summary}{pager}<br/>{items}{pager}',
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getHotelsAppartmentHasHotelsTypeOfFoods(), 'pagination' => ['pageSize' => 20, 'pageParam'=>'page-hotelsappartmenthashotelstypeoffoods']]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('app', 'First'),
        'lastPageLabel'  => Yii::t('app', 'Last')
    ],
    'columns' => [[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'hotels-appartment-has-hotels-type-of-food' . '/' . $action;
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'hotels-appartment-has-hotels-type-of-food'
],
        'hotels_appartment_hotels_info_id',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'hotels_type_of_food_id',
    'value' => function ($model) {
        if ($rel = $model->getHotelsTypeOfFood()->one()) {
            return Html::a($rel->name, ['hotels-type-of-food/view', 'id' => $rel->id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
        'date_add',
        'date_edit',
]
]) . '</div>' ?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('HotelsTypeOfFoods'); ?>
<div style='position: relative'><div style='position:absolute; right: 0px; top: 0px;'>
  <?= Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Hotels Type Of Foods',
            ['hotels-type-of-food/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Hotels Type Of Food',
            ['hotels-type-of-food/create', 'HotelsTypeOfFood' => ['id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-link"></span> ' . Yii::t('app', 'Attach') . ' Hotels Type Of Food', ['hotels-appartment-has-hotels-type-of-food/create', 'HotelsAppartmentHasHotelsTypeOfFood'=>['id'=>$model->id]],
            ['class'=>'btn btn-info btn-xs']
        ) ?>
</div></div><?php Pjax::begin(['id'=>'pjax-HotelsTypeOfFoods', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-HotelsTypeOfFoods ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
    'layout' => '{summary}{pager}<br/>{items}{pager}',
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getHotelsAppartmentHasHotelsTypeOfFoods(), 'pagination' => ['pageSize' => 20, 'pageParam'=>'page-hotelsappartmenthashotelstypeoffoods']]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('app', 'First'),
        'lastPageLabel'  => Yii::t('app', 'Last')
    ],
    'columns' => [[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'hotels-appartment-has-hotels-type-of-food' . '/' . $action;
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'hotels-appartment-has-hotels-type-of-food'
],
        'hotels_appartment_hotels_info_id',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'hotels_type_of_food_id',
    'value' => function ($model) {
        if ($rel = $model->getHotelsTypeOfFood()->one()) {
            return Html::a($rel->name, ['hotels-type-of-food/view', 'id' => $rel->id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
        'date_add',
        'date_edit',
]
]) . '</div>' ?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('HotelsPricings'); ?>
<div style='position: relative'><div style='position:absolute; right: 0px; top: 0px;'>
  <?= Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Hotels Pricings',
            ['hotels-pricing/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Hotels Pricing',
            ['hotels-pricing/create', 'HotelsPricing' => ['hotels_appartment_id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</div></div><?php Pjax::begin(['id'=>'pjax-HotelsPricings', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-HotelsPricings ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
    'layout' => '{summary}{pager}<br/>{items}{pager}',
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getHotelsPricings(), 'pagination' => ['pageSize' => 20, 'pageParam'=>'page-hotelspricings']]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('app', 'First'),
        'lastPageLabel'  => Yii::t('app', 'Last')
    ],
    'columns' => [[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'hotels-pricing' . '/' . $action;
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'hotels-pricing'
],
        'id',
        'hotels_appartment_hotels_info_id',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
/*[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'hotels_others_pricing_id',
    'value' => function ($model) {
        if ($rel = $model->getHotelsOthersPricing()->one()) {
            return Html::a($rel->id, ['hotels-others-pricing/view', 'id' => $rel->id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],*/
        'date',
        //'full_price',

        'name:ntext',
        /*'date_begin',
        'date_end',*/
]
]) . '</div>' ?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('SalOrders'); ?>
<div style='position: relative'><div style='position:absolute; right: 0px; top: 0px;'>
  <?= Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Sal Orders',
            ['sal-order/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Sal Order',
            ['sal-order/create', 'SalOrder' => ['hotels_appartment_id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</div></div><?php Pjax::begin(['id'=>'pjax-SalOrders', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-SalOrders ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
    'layout' => '{summary}{pager}<br/>{items}{pager}',
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getSalOrders(), 'pagination' => ['pageSize' => 20, 'pageParam'=>'page-salorders']]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('app', 'First'),
        'lastPageLabel'  => Yii::t('app', 'Last')
    ],
    'columns' => [[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'sal-order' . '/' . $action;
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'sal-order'
],
        'id',
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
        'date_begin',
        'date_end',
        'enable',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
        [
            'class' => yii\grid\DataColumn::className(),
            'attribute' => 'hotels_info_id',
            'value' => function ($model) {
                if ($rel = $model->getHotelsInfo()->one()) {
                    return Html::a($rel->name, ['hotels-info/view', 'id' => $rel->id,], ['data-pjax' => 0]);
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
                    return Html::a($rel->name, ['tour-type-transport/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                } else {
                    return '';
                }
            },
            'format' => 'raw',
        ],
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
        [
            'class' => yii\grid\DataColumn::className(),
            'attribute' => 'hotels_type_of_food_id',
            'value' => function ($model) {
                if ($rel = $model->getHotelsTypeOfFood()->one()) {
                    return Html::a($rel->name, ['hotels-type-of-food/view', 'id' => $rel->id,], ['data-pjax' => 0]);
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


    <?= Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<b class=""># '.$model->id.'</b>',
    'content' => $this->blocks['common\models\HotelsAppartment'],
    'active'  => true,
],[
    'content' => $this->blocks['HotelsAppartmentHasHotelsTypeOfFoods'],
    'label'   => '<small>Hotels Appartment Has Hotels Type Of Foods <span class="badge badge-default">'.count($model->getHotelsAppartmentHasHotelsTypeOfFoods()->asArray()->all()).'</span></small>',
    'active'  => false,
],[
    'content' => $this->blocks['HotelsTypeOfFoods'],
    'label'   => '<small>Hotels Type Of Foods <span class="badge badge-default">'.count($model->getHotelsTypeOfFoods()->asArray()->all()).'</span></small>',
    'active'  => false,
],[
    'content' => $this->blocks['HotelsPricings'],
    'label'   => '<small>Hotels Pricings <span class="badge badge-default">'.count($model->getHotelsPricings()->asArray()->all()).'</span></small>',
    'active'  => false,
],[
    'content' => $this->blocks['SalOrders'],
    'label'   => '<small>Sal Orders <span class="badge badge-default">'.count($model->getSalOrders()->asArray()->all()).'</span></small>',
    'active'  => false,
], ]
                 ]
    );
    ?>
</div>
