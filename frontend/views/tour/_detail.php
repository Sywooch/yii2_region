<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TourInfo */

?>
<div class="tour-info-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
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
                'label' => Yii::t('app', 'Hotels Info'),
            ],
            [
                'attribute' => 'city.name',
                'label' => Yii::t('app', 'City'),
            ],
            [
                'attribute' => 'tourComposition.name',
                'label' => Yii::t('app', 'Tour Composition'),
            ],
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>