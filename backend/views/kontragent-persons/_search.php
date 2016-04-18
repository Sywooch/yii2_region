<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchKontragentPersons $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="kontragent-persons-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'fname') ?>

		<?= $form->field($model, 'lname') ?>

		<?= $form->field($model, 'oname') ?>

		<?= $form->field($model, 'date_new') ?>

		<?php // echo $form->field($model, 'date_edit') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
