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

$model->date_begin = date('Y-m-d H:i');
    $model->reverse_date_begin = date('Y-m-d H:i');

?>

<div class="bus-way-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-default">
<label>Маршрут "туда"</label>

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
                <p style="font-size: 0.8em">Первая дата из диапазона является началом первой поездки. Вторая - дата, до которой будет генерироваться путевые листы. Пример: при выборе диапазона от 1 июня 2017 11:00 до 30 июня 2017 11:00 и период следования автобус = 10. 1 июня 11:00 это первый выезд, всего в этот период будет сформировано 2 путевых листа. Время окончания будет сформировано автоматически, исходя из "Времени в пути".</p>


                <?= $form->field($model, 'price')->widget(\kartik\money\MaskMoney::className()) ?>

                <?= $form->field($model, 'path_time')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Path Time')]) ?>

                <?= $form->field($model, 'period')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Period')]) ?>


            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-default">
<label>
    Маршрут "обратно"
</label>



                <?= $form->field($model, 'reverse_bus_info_id')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\BusInfo::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Bus info')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($model, 'reverse_bus_route_id')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\BusRoute::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Bus route')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

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
                <p style="font-size: 0.8em">Первая дата из диапазона является началом первой поездки. Вторая - дата, до которой будет генерироваться путевые листы. Пример: при выборе диапазона от 1 июня 2017 11:00 до 30 июня 2017 11:00 и период следования автобус = 10. 1 июня 11:00 это первый выезд, всего в этот период будет сформировано 2 путевых листа. Время окончания будет сформировано автоматически, исходя из "Времени в пути".</p>

                <?= $form->field($model, 'reverse_price')->widget(\kartik\money\MaskMoney::className()) ?>

                <?= $form->field($model, 'reverse_path_time')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Path Time')]) ?>
                <?= $form->field($model, 'reverse_period')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Period')]) ?>



            </div>
        </div>
    </div>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
        <?php if (Yii::$app->controller->action->id == 'generate-view'): ?>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Предварительный расчет') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if (Yii::$app->controller->action->id == 'generate'): ?>
            <?= Html::submitButton(Yii::t('app', 'Сгенерировать'), ['class' => 'btn btn-info', 'value' => '1', 'name' => 'generate']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
