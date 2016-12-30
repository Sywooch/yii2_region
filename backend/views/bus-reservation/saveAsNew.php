<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BusReservation */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
        'modelClass' => 'Bus Reservation',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Reservations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="bus-reservation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
