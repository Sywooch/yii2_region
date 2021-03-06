<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SalOrder */

?>
<div class="sal-order-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'hidden' => true],
            'date',
            [
                'attribute' => 'salOrderStatus.name',
                'label' => Yii::t('app', 'Sal Order Status'),
            ],
            'date_begin',
            'date_end',
            'enable',
            'full_price',
            'insurance_info:ntext',
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info'),
            ],
            [
                'attribute' => 'transInfo.name',
                'label' => Yii::t('app', 'Trans Info'),
            ],
            [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'Userinfo'),
            ],
            [
                'attribute' => 'tourInfo.name',
                'label' => Yii::t('app', 'Tour Info'),
            ],
            [
                'attribute' => 'hotelsAppartment.name',
                'label' => Yii::t('app', 'Hotels Appartment'),
            ],
            'date_add',
            'date_edit',
            ['attribute' => 'lock', 'hidden' => true],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>