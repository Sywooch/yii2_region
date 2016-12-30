<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsAppartment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels Appartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-appartment-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Hotels Appartment') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info')
            ],
            'name:ntext',
            'price',
            [
                'attribute' => 'hotelsAppartmentItem.name',
                'label' => Yii::t('app', 'Hotels Appartment Item')
            ],
            'active',
            'count_rooms',
            'count_beds',
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
        if ($providerHotelsAppartmentHasHotelsTypeOfFood->totalCount) {
            $gridColumnHotelsAppartmentHasHotelsTypeOfFood = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'hotels_info_id',
                [
                    'attribute' => 'hotelsTypeOfFood.name',
                    'label' => Yii::t('app', 'Hotels Type Of Food')
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerHotelsAppartmentHasHotelsTypeOfFood,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Hotels Appartment Has Hotels Type Of Food')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnHotelsAppartmentHasHotelsTypeOfFood
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerHotelsPricing->totalCount) {
            $gridColumnHotelsPricing = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'hotels_info_id',
                [
                    'attribute' => 'hotelsTypeOfFood.name',
                    'label' => Yii::t('app', 'Hotels Type Of Food')
                ],
                'date',
                'name:ntext',
                'active',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerHotelsPricing,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Hotels Pricing')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnHotelsPricing
            ]);
        }
        ?>
    </div>
</div>
