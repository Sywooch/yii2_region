<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-info-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Trans Info') . ' ' . Html::encode($this->title) ?></h2>
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

    <div class="row">
        <?php
        if ($providerSalBasket->totalCount) {
            $gridColumnSalBasket = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'date',
                [
                    'attribute' => 'user.username',
                    'label' => Yii::t('app', 'Userinfo')
                ],
                [
                    'attribute' => 'tourInfo.name',
                    'label' => Yii::t('app', 'Tour Info')
                ],
                [
                    'attribute' => 'hotelsInfo.name',
                    'label' => Yii::t('app', 'Hotels Info')
                ],
                'price',
                'col_day',
                'col_person',
                'col_kids',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerSalBasket,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sal-basket']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Sal Basket')),
        ],
                'columns' => $gridColumnSalBasket
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTransPrice->totalCount) {
            $gridColumnTransPrice = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                [
                    'attribute' => 'transSeats.name',
                    'label' => Yii::t('app', 'Trans Seats')
                ],
                'date_begin',
                'date_end',
                'price',
                'active',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTransPrice,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-trans-price']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Trans Price')),
                ],
                'columns' => $gridColumnTransPrice
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTransSeats->totalCount) {
            $gridColumnTransSeats = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                [
                    'attribute' => 'transSeatsType.name',
                    'label' => Yii::t('app', 'Trans Seats Type')
                ],
                'name',
                'count',
                'active',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTransSeats,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-trans-seats']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Trans Seats')),
                ],
                'columns' => $gridColumnTransSeats
            ]);
        }
        ?>
    </div>
</div>
