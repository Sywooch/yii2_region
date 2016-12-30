<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchHotelsPayPeriod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-hotels-pay-period-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'hotels_pricing_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsPricing::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Hotels pricing')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date Begin'),
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date End'),
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?php /* echo $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Price']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
