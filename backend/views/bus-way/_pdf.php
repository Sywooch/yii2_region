<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusWay */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Ways'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-way-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Bus Way') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name:ntext',
            [
                'attribute' => 'busInfo.name',
                'label' => Yii::t('app', 'Bus Info')
            ],
            'date_begin',
            'date_end',
            'active',
            'ended',
            [
                'attribute' => 'busRoute.name',
                'label' => Yii::t('app', 'Bus Route')
            ],
            'path_time',
            'price',
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
        if ($providerBusReservation->totalCount) {
            $gridColumnBusReservation = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'name',
                [
                    'attribute' => 'busInfo.name',
                    'label' => Yii::t('app', 'Bus Info')
                ],
                'number_seat',
                'date',
                'status',
                'active',
                'person_id',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerBusReservation,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Bus Reservation')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnBusReservation
            ]);
        }
        ?>
    </div>
</div>
