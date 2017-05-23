<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchTourComposition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-tour-composition-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Name')]) ?>

    <?= $form->field($model, 'hotel')->checkbox() ?>

    <?= $form->field($model, 'transport')->checkbox() ?>

    <?= $form->field($model, 'food')->checkbox() ?>

    <?php /* echo $form->field($model, 'transfer')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'insure')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'visa')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'excursion')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
