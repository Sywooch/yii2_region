<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 03.08.16
 * Time: 18:30
 */

//Шаг 1 мастера создания тура для турагенств - выбор всех данных для тура: места проживания и проезда

use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

echo \yii\base\View::render('../layouts/menu.php');
$this->title = Yii::t('app', 'Step 1. Choose tour');
$this->params['breadcrumbs'][] = $this->title;
/*
$this->registerJs('
    $("#reservation-country_id").on("change", function() {
        $.pjax.reload("#reservation-gethotelsinfo div", {
            history: false,
            data: $(this).serialize(),
            type: \'POST\',
            url: \'reservation/gethotelsinfo\',
        });
    });
');

if (!$model->isNewRecord) {
    $this->registerJs('
        $("#reservation-hotels_appartment_hotels_info_id").on("change", function() {
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
    ');

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
    ", yii\web\View::POS_END);
}
*/
?>

    <h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

<?= $form->field($model, 'id', ['template' => '{input}'])->hiddenInput(['style' => 'display:none']); ?>
<?php
$date = new DateTime();
$interval = new DateInterval("P1D");
$date->add($interval);
$model->date_begin = $date->format('Y-m-d');
$interval = new DateInterval("P6D");
$date->add($interval);
$model->date_end = $date->format('Y-m-d');

?>
    <div class="input-group drp-container">

        <?= DateRangePicker::widget([
            'model' => $model,
            'attribute' => 'date_range',
            'useWithAddon' => true,
            'convertFormat' => true,
            'startAttribute' => 'date_begin',
            'endAttribute' => 'date_end',
            'pluginOptions' => [
                'locale' => ['format' => 'Y-m-d'],
                'label' => 'Период заезда',
            ]
        ]);
        ?>

        <span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
    </div>

<?php
if ($model->getCountry()) {
    $countryId = $model->getCountry()->id;
} else {
    $countryId = 0;
}
?>
<?=
$form->field($model, 'country_id')->dropDownList(
    \yii\helpers\ArrayHelper::map(common\models\Country::find()->all(), 'id', 'name'),
    [
        'prompt' => Yii::t('app', 'Select'),
        'options' => [$countryId => ['selected' => true]]
    ]
); ?>

<?php Pjax::begin(['enablePushState' => false, 'id' => 'reservation-hotelsinfo']) ?>
<?= $form->field($model, 'tour_info_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\TourInfo::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Tour info')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

    <div id="reservation-gethotelsinfo">
        <?php
        /*if ($model->isNewRecord) {
            echo $form->field($model, 'hotels_info_id')->dropDownList(
                [],
                ['prompt' => Yii::t('app', 'Choose Hotels info'),
                    'disabled' => '']
            );
        } else {*/
        echo $form->field($model, 'hotels_info_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::find()
                    ->andFilterWhere([
                        'active' => 1,
                        'country' => $model->country_id,
                    ])->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Hotels info')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]
        );
        /*}*/
        ?>
    </div>
<?php Pjax::end(); ?>


<?= $form->field($model, 'hotels_appartment_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsAppartment::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Hotels appartment')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
<?= $form->field($model, 'hotels_type_of_food_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsTypeOfFood::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Type of food')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
<?= $form->field($model, 'trans_info_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\TourTypeTransport::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Tour type transport')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'userinfo_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\Userinfo::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Userinfo')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>


<?php
//TODO Продумать логику проверки: если статус заказа не новый, тогда выводить заголовок "Полная стоимость"
(($model->sal_order_status_id == 1) or ($model->isNewRecord)) ? $price_label = Yii::t('app', 'Price Residence') : $price_label = Yii::t('app', 'Full Price');
?>
<?php /*echo  $form->field($model, 'full_price')->textInput(['placeholder' => $price_label])->label($price_label)*/ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Next'), ['class' => 'btn btn-primary pull-right', 'value' => '1', 'name' => '_toperson']) ?>
    </div>
    <div class="master-tour">

    </div>
<?php ActiveForm::end(); ?>