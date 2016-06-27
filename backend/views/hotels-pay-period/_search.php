<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchHotelsPayPeriod $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="hotels-pay-period-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>


		<?= $form->field($model, 'hotels_pricing_id') ?>

		<?= $form->field($model, 'date_begin') ?>

		<?= $form->field($model, 'date_end') ?>

		<?= $form->field($model, 'active') ?>

		<?php // echo $form->field($model, 'price') ?>

		<?php // echo $form->field($model, 'date_add') ?>

		<?php // echo $form->field($model, 'date_edit') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
