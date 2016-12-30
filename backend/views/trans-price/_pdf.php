<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransPrice */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-price-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Trans Price') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'transInfo.name',
                'label' => Yii::t('app', 'Trans Info')
            ],
            [
                'attribute' => 'transSeats.name',
                'label' => Yii::t('app', 'Trans Seats')
            ],
            'date_begin',
            'date_end',
            'price',
            'active',
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
        if ($providerTransReservation->totalCount) {
            $gridColumnTransReservation = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'name',
                'date_begin',
                'date_end',
                'number_seats',
                'persons',
                'status',
                'active',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTransReservation,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Trans Reservation')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTransReservation
            ]);
        }
        ?>
    </div>
</div>
