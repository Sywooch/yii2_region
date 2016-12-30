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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Hotels Pay Period') . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'),
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            ) ?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'hotelsPricing.name',
                'label' => Yii::t('app', 'Hotels Pricing'),
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
