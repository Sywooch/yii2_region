<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPricing */

?>
<div class="hotels-pricing-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'hotelsAppartment.name',
                'label' => Yii::t('app', 'Hotels Appartment'),
            ],
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info'),
            ],
            [
                'attribute' => 'hotelsTypeOfFood.name',
                'label' => Yii::t('app', 'Hotels Type Of Food'),
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
</div>