<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchBusWay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-bus-way-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bus_info_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\BusInfo::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Bus info')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date Begin'),
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date End'),
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?php /* echo $form->field($model, 'active')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'ended')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'bus_route_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\BusRoute::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Bus route')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'path_time')->textInput(['maxlength' => true, 'placeholder' => 'Path Time']) */ ?>

    <?php /* echo $form->field($model, 'price')->textInput(['placeholder' => 'Price']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
