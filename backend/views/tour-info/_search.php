<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchTourInfo $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="tour-info-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'date_begin') ?>

		<?= $form->field($model, 'date_end') ?>

		<?= $form->field($model, 'days') ?>

		<?php // echo $form->field($model, 'active') ?>

		<?php // echo $form->field($model, 'hotels_info_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
