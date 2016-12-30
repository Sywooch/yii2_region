<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BusReservation */

$this->title = Yii::t('app', 'Create Bus Reservation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Reservations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-reservation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
