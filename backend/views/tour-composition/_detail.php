<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TourComposition */

?>
<div class="tour-composition-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name',
            'hotel:boolean',
            'transport:boolean',
            'food:boolean',
            'transfer:boolean',
            'insure:boolean',
            'visa:boolean',
            'excursion:boolean',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>