<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPayPeriod */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels Pay Periods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-pay-period-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Hotels Pay Period') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'hotelsPricing.name',
                'label' => Yii::t('app', 'Hotels Pricing')
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
