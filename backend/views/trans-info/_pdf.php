<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-info-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Trans Info') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name:ntext',
            [
                'attribute' => 'transType.name',
                'label' => Yii::t('app', 'Trans Type')
            ],
            [
                'attribute' => 'transRoute.name',
                'label' => Yii::t('app', 'Trans Route')
            ],
            'seats',
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
        if ($providerSalBasket->totalCount) {
            $gridColumnSalBasket = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'date',
                [
                    'attribute' => 'user.username',
                    'label' => Yii::t('app', 'Userinfo')
                ],
                [
                    'attribute' => 'tourInfo.name',
                    'label' => Yii::t('app', 'Tour Info')
                ],
                [
                    'attribute' => 'hotelsInfo.name',
                    'label' => Yii::t('app', 'Hotels Info')
                ],
                'price',
                'col_day',
                'col_person',
                'col_kids',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerSalBasket,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Sal Basket')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnSalBasket
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTransPrice->totalCount) {
            $gridColumnTransPrice = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
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
            echo Gridview::widget([
                'dataProvider' => $providerTransPrice,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Trans Price')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTransPrice
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTransSeats->totalCount) {
            $gridColumnTransSeats = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                [
                    'attribute' => 'transSeatsType.name',
                    'label' => Yii::t('app', 'Trans Seats Type')
                ],
                'name',
                'count',
                'active',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTransSeats,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Trans Seats')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTransSeats
            ]);
        }
        ?>
    </div>
</div>
