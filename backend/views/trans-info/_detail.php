<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransInfo */

?>
<div class="trans-info-view">

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
                'attribute' => 'transType.name',
                'label' => Yii::t('app', 'Trans Type'),
            ],
            [
                'attribute' => 'transRoute.name',
                'label' => Yii::t('app', 'Trans Route'),
            ],
            'seats',
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