<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TransReservation */

$this->title = Yii::t('app', 'Create Trans Reservation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Reservations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-reservation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
