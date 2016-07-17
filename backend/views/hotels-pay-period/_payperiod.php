<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
/*
$this->registerJs('
$("#hotelspricing-country").on("change", function() {
$.pjax.reload("#hotelsappartement-gethotelsinfo div div.col-sm-6", {
history: false,
data: $(this).serialize(),
type: \'POST\',
url: \'gethotelsinfo\',

});
});
');

if (!$model->isNewRecord) {
    $this->registerJs('
        $("#hotelspricing-hotels_appartment_hotels_info_id").on("change", function() {
        $.pjax.reload("#pjax-hotelspricing-hotelsinfo div div.col-sm-6", {
        history: false,
        data: $(this).serialize(),
        type: \'POST\',
        url: \'getappartment\',
        
        });
        });'
    );

    $this->registerJs('
    $(function(){
    $(document).on(\'click\', \'[data-toggle=reroute]\', function(e) {
        e.preventDefault();
        var action = $(this).attr(\'href\');
        $.pjax.reload(\'#pjax-hotels-pay-period\', {
                history: false,
                data: $(\'#hotels-pay-period_UpdatePjax input, select\').serialize(),
                type: \'POST\',
                url: action,
                success: function(data){
                    $(\'.result\').html(data);
                },
                error: function(xhr, str){
                    alert(\'Возникла ошибка: \' + xhr.responseCode);
                  }
            });
    });
});
    ', yii\web\View::POS_LOAD);

    $this->registerJs("
    
        function pay_update(){
            $.pjax.reload('#pjax-hotels-pay-period', {
                history: false,
                data: $('#hotels-pay-period_UpdatePjax input, select').serialize(),
                type: 'POST',
                url: '". \yii\helpers\Url::toRoute(['hotels-pay-period/update', 'hotels_pricing_id' => $model->id]) ."',
                success: function(data){
                    $('.result').html(data);
                },
                error: function(xhr, str){
                    alert('Возникла ошибка: ' + xhr.responseCode);
                  }
            });
        };
    ", yii\web\View::POS_LOAD);
}
*/
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