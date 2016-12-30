<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransReservation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Reservations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-reservation-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Trans Reservation') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name',
            'date_begin',
            'date_end',
            'number_seats',
            'price',
            [
                'attribute' => 'person.id',
                'label' => Yii::t('app', 'Person')
            ],
            'status',
            [
                'attribute' => 'transPrice.id',
                'label' => Yii::t('app', 'Trans Price')
            ],
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
