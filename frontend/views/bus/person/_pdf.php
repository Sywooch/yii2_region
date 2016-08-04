<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\bus\Person */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Person') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            'firstname',
            'lastname',
            'secondname',
            'date_new',
            'date_edit',
            'passport_ser',
            'passport_num',
            'contacts:ntext',
            'other:ntext',
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerBusReservationHasPerson->totalCount) {
            $gridColumnBusReservationHasPerson = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'busReservation.name',
                    'label' => Yii::t('app', 'Bus Reservation')
                ],
                'date_add',
                'date_edit',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerBusReservationHasPerson,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Bus Reservation Has Person')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnBusReservationHasPerson
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerSalOrderHasPerson->totalCount) {
            $gridColumnSalOrderHasPerson = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'salOrder.id',
                    'label' => Yii::t('app', 'Sal Order')
                ],
                'date_add',
                'date_edit',
                'update_by',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerSalOrderHasPerson,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Sal Order Has Person')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnSalOrderHasPerson
            ]);
        }
        ?>
    </div>
</div>
