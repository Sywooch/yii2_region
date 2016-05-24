<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchTransRoute $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="trans-route-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'date_begin') ?>

		<?= $form->field($model, 'date_end') ?>

		<?= $form->field($model, 'active') ?>

		<?= $form->field($model, 'begin_point') ?>

		<?php // echo $form->field($model, 'end_point') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
