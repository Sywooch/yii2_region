<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TourInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tour Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-info-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Tour Info') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name:ntext',
            'date_begin',
            'date_end',
            'days',
            'active',
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info')
            ],
            [
                'attribute' => 'city.name',
                'label' => Yii::t('app', 'City')
            ],
            [
                'attribute' => 'tourComposition.name',
                'label' => Yii::t('app', 'Tour Composition')
            ],
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
        if ($providerTourInfoHasTourType->totalCount) {
            $gridColumnTourInfoHasTourType = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'tourType.name',
                    'label' => Yii::t('app', 'Tour Type')
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTourInfoHasTourType,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Tour Info Has Tour Type')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTourInfoHasTourType
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTourInfoHasTourTypeTransport->totalCount) {
            $gridColumnTourInfoHasTourTypeTransport = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'tourTypeTransport.name',
                    'label' => Yii::t('app', 'Tour Type Transport')
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTourInfoHasTourTypeTransport,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Tour Info Has Tour Type Transport')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTourInfoHasTourTypeTransport
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTourPrice->totalCount) {
            $gridColumnTourPrice = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'price',
                'date',
                'active',
                'date_begin',
                'date_end',
                'in_hotels',
                'in_trans',
                'in_food',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTourPrice,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Tour Price')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTourPrice
            ]);
        }
        ?>
    </div>
</div>
