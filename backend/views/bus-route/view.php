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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Bus Route') . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'),
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            ) ?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
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

                [
                    'label' => Yii::t('app', 'First Point'),
                    'attribute' => 'first_point',
                    'class' => '\kartik\grid\BooleanColumn',
                ],

                [
                    'label' => Yii::t('app', 'End Point'),
                    'attribute' => 'end_point',
                    'class' => '\kartik\grid\BooleanColumn',
                ],
                'position',
                'date_point_forward',
                'time_pause:ntext',
                'date_point_reverse',
            ];
            echo GridView::widget([
                'dataProvider' => $providerBusRouteHasBusRoutePoint,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-bus-route-has-bus-route-point']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Bus Route Has Bus Route Point')),
                ],
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
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-bus-way']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Bus Way')),
                ],
                'columns' => $gridColumnBusWay
            ]);
        }
        ?>
    </div>
</div>
