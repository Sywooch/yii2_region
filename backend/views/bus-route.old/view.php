<?php

use dmstr\bootstrap\Tabs;
use dmstr\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var common\models\BusRoute $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('app', 'BusRoute');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BusRoutes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
?>
<div class="giiant-crud bus-route-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('app', 'BusRoute') ?>
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
                ['create', 'id' => $model->id, 'BusRoute' => $copyParams],
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

    <?php $this->beginBlock('common\models\BusRoute'); ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'date',
            'date_begin',
            'date_end',
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



    <?php $this->beginBlock('BusRoutePoints'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Bus Route Points',
                ['bus-route-point/index'],
                ['class' => 'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Bus Route Point',
                ['bus-route-point/create', 'BusRoutePoint' => ['id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            ); ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-link"></span> ' . Yii::t('app', 'Attach') . ' Bus Route Point', ['bus-route-has-bus-route-point/create', 'BusRouteHasBusRoutePoint' => ['bus_route_id' => $model->id]],
                ['class' => 'btn btn-info btn-xs']
            ) ?>
        </div>
    </div><?php Pjax::begin(['id' => 'pjax-BusRoutePoints', 'enableReplaceState' => false, 'linkSelector' => '#pjax-BusRoutePoints ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    <?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getBusRouteHasBusRoutePoints(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-busroutehasbusroutepoints']]),
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
                $params[0] = 'bus-route-has-bus-route-point' . '/' . $action;
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
            'controller' => 'bus-route-has-bus-route-point'
        ],
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'bus_route_point_id',
                'value' => function ($model) {
                    if ($rel = $model->getBusRoutePoint()->one()) {
                        return Html::a($rel->name, ['bus-route-point/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            'first_point',
            'end_point',
            'position',
        ]
    ]) . '</div>' ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('BusWays'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Bus Ways',
                ['bus-way/index'],
                ['class' => 'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Bus Way',
                ['bus-way/create', 'BusWay' => ['bus_path_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            ); ?>
        </div>
    </div><?php Pjax::begin(['id' => 'pjax-BusWays', 'enableReplaceState' => false, 'linkSelector' => '#pjax-BusWays ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    <?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getBusWays(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-busways']]),
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
                $params[0] = 'bus-way' . '/' . $action;
                return $params;
            },
            'buttons' => [

            ],
            'controller' => 'bus-way'
        ],
            'id',
            'name:ntext',
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'bus_info_id',
                'value' => function ($model) {
                    if ($rel = $model->getBusInfo()->one()) {
                        return Html::a($rel->name, ['bus-info/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            'date_create',
            'date_begin',
            'date_end',
            'active',
            'ended',
            'path_time',
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
                'content' => $this->blocks['common\models\BusRoute'],
                'active' => true,
            ], [
                'content' => $this->blocks['BusRoutePoints'],
                'label' => '<small>Bus Route Points <span class="badge badge-default">' . count($model->getBusRoutePoints()->asArray()->all()) . '</span></small>',
                'active' => false,
            ], [
                'content' => $this->blocks['BusWays'],
                'label' => '<small>Bus Ways <span class="badge badge-default">' . count($model->getBusWays()->asArray()->all()) . '</span></small>',
                'active' => false,
            ],]
        ]
    );
    ?>
</div>
