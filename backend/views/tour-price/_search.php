<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchTourPrice $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="tour-price-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'price') ?>

		<?= $form->field($model, 'date') ?>

		<?= $form->field($model, 'active') ?>

		<?= $form->field($model, 'date_begin') ?>

		<?php // echo $form->field($model, 'date_end') ?>

		<?php // echo $form->field($model, 'tour_info_id') ?>

		<?php // echo $form->field($model, 'in_hotels') ?>

		<?php // echo $form->field($model, 'in_trans') ?>

		<?php // echo $form->field($model, 'in_food') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
