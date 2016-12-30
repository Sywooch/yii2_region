<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPricing */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels Pricings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-pricing-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Hotels Pricing') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'hotelsAppartment.name',
                'label' => Yii::t('app', 'Hotels Appartment')
            ],
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info')
            ],
            [
                'attribute' => 'hotelsTypeOfFood.name',
                'label' => Yii::t('app', 'Hotels Type Of Food')
            ],
            'name:ntext',
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
        if ($providerHotelsPayPeriod->totalCount) {
            $gridColumnHotelsPayPeriod = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'date_begin',
                'date_end',
                'active',
                'price',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerHotelsPayPeriod,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Hotels Pay Period')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnHotelsPayPeriod
            ]);
        }
        ?>
    </div>
</div>
