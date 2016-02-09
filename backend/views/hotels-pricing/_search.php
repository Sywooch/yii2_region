<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchHotelsPricing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotels-pricing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hotels_appartment_id') ?>

    <?= $form->field($model, 'hotels_appartment_hotels_info_id') ?>

    <?= $form->field($model, 'hotels_others_pricing_id') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'full_price') ?>

    <?php // echo $form->field($model, 'discount_id') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'date_begin') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'hotels_type_of_food_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
