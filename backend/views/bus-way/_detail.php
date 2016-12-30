<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusWay */

?>
<div class="bus-way-view">

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
            [
                'attribute' => 'busInfo.name',
                'label' => Yii::t('app', 'Bus Info'),
            ],
            'date_begin',
            'date_end',
            'active',
            'ended',
            [
                'attribute' => 'busRoute.name',
                'label' => Yii::t('app', 'Bus Route'),
            ],
            'path_time',
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