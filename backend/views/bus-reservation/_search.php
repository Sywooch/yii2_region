<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchBusReservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-bus-reservation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'bus_info_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\BusInfo::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Bus info')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'bus_way_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\BusWay::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Bus way')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'person_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Person::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Person')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php /* echo $form->field($model, 'number_seat')->textInput(['placeholder' => 'Number Seat']) */ ?>

    <?php /* echo $form->field($model, 'date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date'),
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'active')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
