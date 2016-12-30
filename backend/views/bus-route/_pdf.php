<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusRoute */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-route-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Bus Route') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name:ntext',
            'date',
            'date_begin',
            'date_end',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerBusRouteHasBusRoutePoint->totalCount) {
            $gridColumnBusRouteHasBusRoutePoint = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'busRoutePoint.name',
                    'label' => Yii::t('app', 'Bus Route Point')
                ],
                'first_point',
                'end_point',
                'position',
                'date_point_forward',
                'time_pause:datetime',
                'date_point_reverse',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerBusRouteHasBusRoutePoint,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Bus Route Has Bus Route Point')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnBusRouteHasBusRoutePoint
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerBusWay->totalCount) {
            $gridColumnBusWay = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'name:ntext',
                [
                    'attribute' => 'busInfo.name',
                    'label' => Yii::t('app', 'Bus Info')
                ],
                //'date_create',
                'date_begin',
                'date_end',
                'active',
                'ended',
                'path_time',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerBusWay,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Bus Way')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnBusWay
            ]);
        }
        ?>
    </div>
</div>
