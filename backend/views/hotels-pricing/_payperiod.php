<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin([
    'action' => Url::toRoute(['hotels-pay-period/update', 'hotels_pricing_id' => $model->id]),
    'options' => [
        'data-pjax' => '1'
    ],
    'id' => 'hotelsPayPeriodsUpdateForm'
]); ?>
    <div id="hotels-pay-period_UpdatePjax">
        
<?php
$i = 1;
foreach ($model->hotelsPayPeriods as $key => $payperiod): ?>
    <div class="row pay-period">
        <div style="display:none">
        <?= $form->field($payperiod, "[$key]id")->hiddenInput()->label(false, ['style'=>'display:none'])
        ?>
        </div>
        <label class="pull-left vcenter">№ <?= $i++ ?></label>
        <div class="col-lg-4">
            <label class="control-label"><?= Yii::t('app', 'Date Begin and End')?></label>
            <?=
            \kartik\widgets\DatePicker::widget([
                'model' => $payperiod,
                'attribute' => "[$key]date_begin",
                'attribute2' => "[$key]date_end",
                'language' => 'ru',
                'options' => ['placeholder' => Yii::t('app','Date Begin')],
                'options2' => ['placeholder' => Yii::t('app','Date End')],
                'type' => \kartik\widgets\DatePicker::TYPE_RANGE,
                'form' => $form,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'autoclose' => true,
                ]
            ]);
            ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($payperiod, "[$key]price", ['enableAjaxValidation' => true])->textInput() ?>
        </div>
        <div class="col-lg-1 vcenter">
            <?= $form->field($payperiod, "[$key]active", ['enableAjaxValidation' => true])->checkbox() ?>
        </div>
        <div class="col-lg-1 vcenter">
            
            <?= Html::a('', Url::toRoute(['hotels-pay-period/delete', 'id' => $payperiod->id]), [
                'class' => 'glyphicon glyphicon-trash',
                'data' => [
                    'toggle' => 'reroute'
                ]
            ]) ?>
        </div>
    </div>
    
<?php endforeach ?>

<?= Html::a('Добавить период', Url::toRoute(['hotels-pay-period/create', 'hotels_pricing_id' => $model->id]), [
    'class' => 'btn btn-success',
    'data' => [
        'toggle' => 'reroute',
        'action' => Url::toRoute(['hotels-pay-period/create', 'hotels_pricing_id' => $model->id])
    ]
]) ?>
        <?= Html::button('Сохранить', ['class' => 'btn btn-primary', 'onClick' => 'pay_update()']) ?>
    </div>

<?php ActiveForm::end(); ?>