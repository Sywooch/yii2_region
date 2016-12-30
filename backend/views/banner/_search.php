<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\SearchBanner $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="banner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'file') ?>

    <?= $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'options') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'date_add') ?>

    <?php // echo $form->field($model, 'date_edit') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'lock') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
