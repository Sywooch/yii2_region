<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPayPeriod */

?>
<div class="hotels-pay-period-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'hotelsPricing.name',
                'label' => Yii::t('app', 'Hotels Pricing'),
            ],
            'date_begin',
            'date_end',
            'active',
            'price',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>