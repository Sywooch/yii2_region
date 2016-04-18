<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchBusReservation $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="bus-reservation-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'bus_info_id') ?>

		<?= $form->field($model, 'bus_way_id') ?>

		<?= $form->field($model, 'kontragent_persons_id') ?>

		<?php // echo $form->field($model, 'number_seat') ?>

		<?php // echo $form->field($model, 'date') ?>

		<?php // echo $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
