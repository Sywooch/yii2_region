<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TourInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tour Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-info-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Tour Info') . ' ' . Html::encode($this->title) ?></h2>
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
        'date_begin',
        'date_end',
        'days',
            'active',
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info'),
            ],
            [
                'attribute' => 'city.name',
                'label' => Yii::t('app', 'City'),
            ],
            /*[
                'attribute' => 'tourComposition.name',
                'label' => Yii::t('app', 'Tour Composition'),
            ],*/
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
                    'attribute' => 'userinfo.username',
                    'label' => Yii::t('app', 'Userinfo')
                ],
                [
                    'attribute' => 'hotelsInfo.name',
                    'label' => Yii::t('app', 'Hotels Info')
                ],
                [
                    'attribute' => 'transInfo.name',
                    'label' => Yii::t('app', 'Trans Info')
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
        if ($providerSalOrder->totalCount) {
            $gridColumnSalOrder = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'date',
                [
                    'attribute' => 'salOrderStatus.name',
                    'label' => Yii::t('app', 'Sal Order Status')
                ],
                'date_begin',
                'date_end',
                'enable',
                [
                    'attribute' => 'hotelsInfo.name',
                    'label' => Yii::t('app', 'Hotels Info')
                ],
                [
                    'attribute' => 'hotelsAppartment.name',
                    'label' => Yii::t('app', 'Hotels Appartment')
                ],
                [
                    'attribute' => 'transInfo.name',
                    'label' => Yii::t('app', 'Trans Info')
                ],
                [
                    'attribute' => 'hotelsTypeOfFood.name',
                    'label' => Yii::t('app', 'Hotels Type Of Food')
                ],
                [
                    'attribute' => 'userinfo.username',
                    'label' => Yii::t('app', 'Userinfo')
                ],
                'full_price',
                'insurance_info:ntext',
                ['attribute' => 'lock', 'visible' => false],
                'hotels_appartment_full_sale',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerSalOrder,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sal-order']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Sal Order')),
                ],
                'columns' => $gridColumnSalOrder
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTourInfoHasTourType->totalCount) {
            $gridColumnTourInfoHasTourType = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'tourType.name',
                    'label' => Yii::t('app', 'Tour Type')
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTourInfoHasTourType,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tour-info-has-tour-type']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Tour Info Has Tour Type')),
                ],
                'columns' => $gridColumnTourInfoHasTourType
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTourInfoHasTourTypeTransport->totalCount) {
            $gridColumnTourInfoHasTourTypeTransport = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'tourTypeTransport.name',
                    'label' => Yii::t('app', 'Tour Type Transport')
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTourInfoHasTourTypeTransport,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tour-info-has-tour-type-transport']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Tour Info Has Tour Type Transport')),
                ],
                'columns' => $gridColumnTourInfoHasTourTypeTransport
            ]);
        }
        ?>
    </div>
    <div class="row">
        <?php
        if($providerTourOtherPrice->totalCount){
        $gridColumnTourOtherPrice = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'name',
                'price',
                'active',
                ['attribute' => 'lock', 'visible' => false],
        ];
            echo Gridview::widget([
                'dataProvider' => $providerTourOtherPrice,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tour-other-price']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Tour Other Price')),
                ],
                'columns' => $gridColumnTourOtherPrice
            ]);
        }
        ?>
    </div>
    <div class="row">
        <?php
        if ($providerTourPrice->totalCount) {
            $gridColumnTourPrice = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'price',
                //'date',
                'active',
                'date_begin',
                'date_end',
                'in_hotels',
                'in_trans',
                'in_food',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTourPrice,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tour-price']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Tour Price')),
                ],
                'columns' => $gridColumnTourPrice
            ]);
        }
        ?>
    </div>
</div>
