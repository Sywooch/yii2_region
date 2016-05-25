<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchBusRouteHasBusRoutePoint $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="bus-route-has-bus-route-point-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'bus_route_id') ?>

		<?= $form->field($model, 'bus_route_point_id') ?>

		<?= $form->field($model, 'first_point') ?>

		<?= $form->field($model, 'end_point') ?>

		<?= $form->field($model, 'position') ?>

		<?php // echo $form->field($model, 'date_point_forward') ?>

		<?php // echo $form->field($model, 'time_pause') ?>

		<?php // echo $form->field($model, 'date_point_reverse') ?>

		<?php // echo $form->field($model, 'date_add') ?>

		<?php // echo $form->field($model, 'date_edit') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
