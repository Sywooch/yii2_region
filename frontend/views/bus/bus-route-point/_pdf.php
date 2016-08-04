<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\bus\BusRoutePoint */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Route Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-route-point-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Bus Route Point') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            'name:ntext',
            'gps_point_m:ntext',
            'gps_point_p:ntext',
            'active',
            'description:ntext',
            'date',
            'date_add',
            'date_edit',
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
                    'attribute' => 'busRoute.name',
                    'label' => Yii::t('app', 'Bus Route')
                ],
                'first_point',
                'end_point',
                'position',
                'date_point_forward',
                'time_pause:datetime',
                'date_point_reverse',
                'date_add',
                'date_edit',
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
</div>
