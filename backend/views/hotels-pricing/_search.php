<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchHotelsPricing $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="hotels-pricing-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'hotels_appartment_id') ?>

		<?= $form->field($model, 'hotels_appartment_hotels_info_id') ?>

		<?= $form->field($model, 'hotels_type_of_food_id') ?>

		<?= $form->field($model, 'date') ?>

		<?php // echo $form->field($model, 'name') ?>

		<?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
