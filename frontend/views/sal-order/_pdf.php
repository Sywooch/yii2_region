<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\SalOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sal Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sal-order-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Sal Order') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            'date',
            [
                'attribute' => 'salOrderStatus.name',
                'label' => Yii::t('app', 'Sal Order Status')
            ],
            'persons:ntext',
            'child',
            'date_begin',
            'date_end',
            'enable',
            'full_price',
            'insurance_info:ntext',
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info')
            ],
            [
                'attribute' => 'transInfo.name',
                'label' => Yii::t('app', 'Trans Info')
            ],
            [
                'attribute' => 'userinfo.username',
                'label' => Yii::t('app', 'Userinfo')
            ],
            [
                'attribute' => 'tourInfo.name',
                'label' => Yii::t('app', 'Tour Info')
            ],
            [
                'attribute' => 'hotelsAppartment.name',
                'label' => Yii::t('app', 'Hotels Appartment')
            ],
            'date_add',
            'date_edit',
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>
