<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsAppartment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels Appartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$items = $model->getImage2amigos(true);
?>
<div class="hotels-appartment-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Hotels Appartment') . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'),
                ['pdf', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            ) ?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id], ['class' => 'btn btn-info']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id], [
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
            'attribute' => 'hotelsInfo.name',
            'label' => Yii::t('app', 'Hotels Info'),
        ],
        'name:ntext',
        'price',
        [
            'attribute' => 'hotelsAppartmentItem.name',
            'label' => Yii::t('app', 'Hotels Appartment Item'),
        ],
            'active:boolean',
        'count_rooms',
        'count_beds',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);

        ?>
        <?= \dosamigos\gallery\Gallery::widget(['items' => $items,
            'options' => [
                'class' => 'row',
            ],
        ]); ?>
    </div>

    <div class="row">
        <?php
        if ($providerHotelsAppartmentHasHotelsTypeOfFood->totalCount) {
            $gridColumnHotelsAppartmentHasHotelsTypeOfFood = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'hotels_info_id',
                [
                    'attribute' => 'hotelsTypeOfFood.name',
                    'label' => Yii::t('app', 'Hotels Type Of Food')
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerHotelsAppartmentHasHotelsTypeOfFood,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-hotels-appartment-has-hotels-type-of-food']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Hotels Appartment Has Hotels Type Of Food')),
                ],
                'columns' => $gridColumnHotelsAppartmentHasHotelsTypeOfFood
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerHotelsPricing->totalCount) {
            $gridColumnHotelsPricing = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'hotels_info_id',
                [
                    'attribute' => 'hotelsTypeOfFood.name',
                    'label' => Yii::t('app', 'Hotels Type Of Food')
                ],

                'name:ntext',
                'active',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerHotelsPricing,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-hotels-pricing']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Hotels Pricing')),
                ],
                'columns' => $gridColumnHotelsPricing
            ]);
        }
        ?>
    </div>
</div>
