<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusWay */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('
function calcDate(){
    var dateA = moment($("#busway-rangedate1-start").val());
    var dateB = moment($("#busway-rangedate1-end").val());
    
    return dateB.diff(dateA, "hours");
}
$("#busway-rangedate1-start").change(function(){
    $("#busway-path_time").val(calcDate());
});
$("#busway-rangedate1-end").change(function(){
    $("#busway-path_time").val(calcDate());
});
');

$this->registerJs('
$("#busway-b_reverse").change(function() {
if ($(this).prop("checked")) {
    $("#busway-form-reverse-rangedate2").show();
}
else{
    $("#busway-form-reverse-rangedate2").hide();
} 
});
');

if ($model->isNewRecord){
    $model->reverse_date_begin = date('Y-m-d H:i');
}

?>

<div class="bus-way-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'bus_info_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\BusInfo::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Bus info')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'bus_route_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\BusRoute::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Bus route')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'price')->widget(\kartik\money\MaskMoney::className()) ?>

    <label class="control-label">Период маршрута</label>
    <div class="input-group drp-container">
        <?php
        $addon = <<< HTML
<span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
HTML;
        echo \kartik\daterange\DateRangePicker::widget([
                'model' => $model,
                'attribute' => 'rangedate1',
                'useWithAddon' => true,
                'convertFormat' => true,
                'startAttribute' => 'date_begin',
                'endAttribute' => 'date_end',
                //'saveFormat' => 'php:Y-m-d H:i:s',
                'pluginOptions' => [
                    'timePicker' => true,
                    'timePickerIncrement' => 10,
                    'locale' => ['format' => 'Y-m-d H:i'],
                    'opens' => 'left',
                ]
            ]) . $addon;
        ?>
    </div>

    <?= $form->field($model, 'path_time')->textInput(['maxlength' => true, 'placeholder' => 'Path Time']) ?>
    <div class="panel panel-default" style="padding: 10px;">
        <p><strong>Активация обратного путевого листа (при наличии такого маршрута):</strong></p>
        <div class="container-fluid">
            <?= $form->field($model, 'b_reverse')->checkbox() ?>

            <div id="busway-form-reverse-rangedate2" style="display: none; margin-bottom: 20px;">

                <label class="control-label">Расписание маршрута</label>
                <div class="input-group drp-container">
                    <?php
                    $addon = <<< HTML
<span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
HTML;
                    echo \kartik\daterange\DateRangePicker::widget([
                            'model' => $model,
                            'attribute' => 'rangedate2',
                            'useWithAddon' => true,
                            'convertFormat' => true,
                            'startAttribute' => 'reverse_date_begin',
                            'endAttribute' => 'reverse_date_end',
                            //'saveFormat' => 'php:Y-m-d H:i:s',
                            'pluginOptions' => [
                                'timePicker' => true,
                                'timePickerIncrement' => 10,
                                'locale' => ['format' => 'Y-m-d H:i'],
                                'opens' => 'left',
                            ]
                        ]) . $addon;
                    ?>
                </div>
            </div>
        </div>

    </div>

    <?= $form->field($model, 'active')->checkbox() ?>



    <?= $form->field($model, 'ended')->checkbox() ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if (Yii::$app->controller->action->id != 'create'): ?>
            <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
