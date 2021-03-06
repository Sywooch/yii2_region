<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var common\models\BusRouteHasBusRoutePoint $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('app', 'BusRouteHasBusRoutePoint');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BusRouteHasBusRoutePoints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->bus_route_id, 'url' => ['view', 'bus_route_id' => $model->bus_route_id, 'bus_route_point_id' => $model->bus_route_point_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
?>
<div class="giiant-crud bus-route-has-bus-route-point-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('app', 'BusRouteHasBusRoutePoint') ?>        <small>
            <?= $model->bus_route_id ?>        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a(
            '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Edit'),
            [ 'update', 'bus_route_id' => $model->bus_route_id, 'bus_route_point_id' => $model->bus_route_point_id],
            ['class' => 'btn btn-info']) ?>

            <?= Html::a(
            '<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('app', 'Copy'),
            ['create', 'bus_route_id' => $model->bus_route_id, 'bus_route_point_id' => $model->bus_route_point_id, 'BusRouteHasBusRoutePoint'=>$copyParams],
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

    <?php $this->beginBlock('common\models\BusRouteHasBusRoutePoint'); ?>

    
    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
    // generated by schmunk42\giiant\generators\crud\providers\RelationProvider::attributeFormat
[
    'format' => 'html',
    'attribute' => 'bus_route_id',
    'value' => ($model->getBusRoute()->one() ? Html::a($model->getBusRoute()->one()->name, ['bus-route/view', 'id' => $model->getBusRoute()->one()->id,]) : '<span class="label label-warning">?</span>'),
],
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::attributeFormat
[
    'format' => 'html',
    'attribute' => 'bus_route_point_id',
    'value' => ($model->getBusRoutePoint()->one() ? Html::a($model->getBusRoutePoint()->one()->name, ['bus-route-point/view', 'id' => $model->getBusRoutePoint()->one()->id,]) : '<span class="label label-warning">?</span>'),
],
        'first_point',
        'end_point',
        'position',
        'date_point_forward',
        'time_pause:datetime',
        'date_point_reverse',
        'date_add',
        'date_edit',
    ],
    ]); ?>

    
    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'bus_route_id' => $model->bus_route_id, 'bus_route_point_id' => $model->bus_route_point_id],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => '' . Yii::t('app', 'Are you sure to delete this item?') . '',
    'data-method' => 'post',
    ]); ?>
    <?php $this->endBlock(); ?>


    
    <?= Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<b class=""># '.$model->bus_route_id.'</b>',
    'content' => $this->blocks['common\models\BusRouteHasBusRoutePoint'],
    'active'  => true,
], ]
                 ]
    );
    ?>
</div>
