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
            ['attribute' => 'id', 'visible' => false],
            'date',
            [
                'attribute' => 'salOrderStatus.name',
                'label' => Yii::t('app', 'Sal Order Status'),
            ],
            'date_begin',
            'date_end',
            'enable',
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info'),
            ],
            [
                'attribute' => 'hotelsAppartment.name',
                'label' => Yii::t('app', 'Hotels Appartment'),
            ],
            [
                'attribute' => 'transInfo.name',
                'label' => Yii::t('app', 'Trans Info'),
            ],
            [
                'attribute' => 'hotelsTypeOfFood.name',
                'label' => Yii::t('app', 'Hotels Type Of Food'),
            ],
            [
                'attribute' => 'userinfo.username',
                'label' => Yii::t('app', 'Userinfo'),
            ],
            [
                'attribute' => 'tourInfo.name',
                'label' => Yii::t('app', 'Tour Info'),
            ],
            'full_price',
            'insurance_info:ntext',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>