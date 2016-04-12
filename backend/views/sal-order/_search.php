<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchSalOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sal-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'sal_order_status_id') ?>

    <?= $form->field($model, 'hotels_info') ?>

    <?= $form->field($model, 'transport_info') ?>

    <?php // echo $form->field($model, 'persons') ?>

    <?php // echo $form->field($model, 'child') ?>

    <?php // echo $form->field($model, 'date_begin') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <?php // echo $form->field($model, 'full_price') ?>

    <?php // echo $form->field($model, 'insurance_info') ?>

    <?php // echo $form->field($model, 'hotels_info_id') ?>

    <?php // echo $form->field($model, 'trans_info_id') ?>

    <?php // echo $form->field($model, 'userinfo_id') ?>

    <?php // echo $form->field($model, 'tour_info_id') ?>

    <?php // echo $form->field($model, 'hotels_appartment_id') ?>

    <?php // echo $form->field($model, 'hotels_appartment_hotels_info_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
