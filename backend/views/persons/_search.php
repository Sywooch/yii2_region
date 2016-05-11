<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchPersons $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="persons-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'firstname') ?>

		<?= $form->field($model, 'lastname') ?>

		<?= $form->field($model, 'secondname') ?>

		<?= $form->field($model, 'date_new') ?>

		<?php // echo $form->field($model, 'date_edit') ?>

		<?php // echo $form->field($model, 'passport_ser') ?>

		<?php // echo $form->field($model, 'passport_num') ?>

		<?php // echo $form->field($model, 'contacts') ?>

		<?php // echo $form->field($model, 'other') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
