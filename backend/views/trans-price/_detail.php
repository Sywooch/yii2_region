<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransPrice */

?>
<div class="trans-price-view">

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
                'attribute' => 'transInfo.name',
                'label' => Yii::t('app', 'Trans Info'),
            ],
            [
                'attribute' => 'transSeats.name',
                'label' => Yii::t('app', 'Trans Seats'),
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
</div>