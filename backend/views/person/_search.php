<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchPerson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) ?>

    <?= $form->field($model, 'secondname')->textInput(['maxlength' => true, 'placeholder' => 'Secondname']) ?>

    <?= $form->field($model, 'date_new')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date New'),
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?php /* echo $form->field($model, 'passport_ser')->textInput(['maxlength' => true, 'placeholder' => 'Passport Ser']) */ ?>

    <?php /* echo $form->field($model, 'passport_num')->textInput(['maxlength' => true, 'placeholder' => 'Passport Num']) */ ?>

    <?php /* echo $form->field($model, 'birthday')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Birthday'),
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'contacts')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'other')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'child')->textInput(['placeholder' => 'Child']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <?php /* echo $form->field($model, 'gender_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Gender::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Gender')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
