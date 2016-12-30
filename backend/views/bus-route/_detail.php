<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusRoute */

?>
<div class="bus-route-view">

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
            'date',
            'date_begin',
            'date_end',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>