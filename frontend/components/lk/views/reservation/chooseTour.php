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

echo \yii\base\View::render('../layouts/menu.php');
$this->title = Yii::t('app', 'Step 1. Choose tour');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('
    $("#lkorder-hotels_info_id").on("change",function(){
    
        if ($(this).val() != null){
            $.ajax({
                type: "POST",
                url: "/lk/reservation/child-hotels-info",
                data: "hotels=" + $(this).val(),
                success: function(answer){
                    $("#lkorder-hotels-info-details").html(answer);
                }
            });
        }
        
    });
');
$this->registerJs('
    $("#lkorder-trans_route").on("change",function(){
    
        if (($(this).val() != null) && ($(this).val() != "")){
            $.ajax({
                type: "POST",
                url: "/lk/reservation/get-trans-info",
                data: "trans=" + $(this).val() + "&transType=" + $("#lkorder-trans_info_id").val(),
                success: function(answer){
                    $("#lkorder-trans-info-details").html(answer);
                }
            });
        }
    });
');

$this->registerJs('
    $("#lkorder-trans_route_reverse").on("change",function(){
    
        if (($(this).val() != null) && ($(this).val() != "")){
            $.ajax({
                type: "POST",
                url: "/lk/reservation/get-trans-info",
                data: "trans=" + $(this).val() + "&transType=" + $("#lkorder-trans_info_id_reverse").val(),
                success: function(answer){
                    $("#lkorder-trans-info-details-reverse").html(answer);
                }
            });
        }
    });
');

$this->registerJs('
    $("#lkorder-childcount").on("change",function(){
        c = $(this).val();
        if (($(this).val() != null) && ($(this).val() != "")){
            for(i = 0; i <= 4; i++){
                if (c == 0){
                    $("#tourist-child-years-label").hide();
                }
                else{
                    $("#tourist-child-years-label").show();
                }
                if (i <= c){
                    console.log(c);
                    $("#tourist-child-years-" + i).show();
                }
                else{
                    $("#tourist-child-years-" + i).hide();
                }
            }
        }
    }
    );
');

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

$hotelsInfoData = null;
$cityTo = null;
if (isset($model->hotels_info_id)) {
    $hotelsInfoData =
        \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::find()
            ->andWhere(['id' => $model->hotels_info_id])->asArray()->all(), 'id', 'name');


}
$countryId = 0;
$starsId = 0;
if ($model->getCountry()) {
    $countryId = $model->getCountry()->id;
    /*$hotelsInfoData =
        \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::find()
            ->activeTour()
            ->andWhere(['country'=>$countryId])
            ->orderBy('id')
            ->asArray()
            ->all(), 'id', 'name');*/
}
if ($model->getStars()) {
    $starsId = $model->getStars()->id;
}

$cityTo = null;

if ($countryId !== 0) {
    $cityTo = \yii\helpers\ArrayHelper::map(common\models\City::find()
        ->andWhere(['country_id' => $countryId])
        ->asArray()->all(), 'id', 'name');
    if ($hotelsInfoData != null) {
        $a = \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::find()
            ->andWhere(['id' => $model->hotels_info_id])->asArray()->all(), 'id', 'city_id');
        $model->city_id = $a[$model->hotels_info_id];
    }
}
?>
    <div class="date-range">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Когда отдыхаем?</h3>
            </div>
            <div class="panel-body">

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
            </div>
        </div>
    </div>

<?= Yii::$app->controller->renderPartial('_tourTourist', ['model' => $model, 'form' => $form]); ?>

    <div class="tour-info">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Куда едем?</h3>
            </div>
            <div class="panel-body">
                <?=
                $form->field($model, 'country_id')->widget(\kartik\widgets\Select2::className(), [
                        'data' => \yii\helpers\ArrayHelper::map(common\models\Country::find()->asArray()->all(), 'id', 'name'),
                        'options' => [

                            'prompt' => Yii::t('app', 'Select'),
                            'options' => [$countryId => ['selected' => true]],
                            //'id'=>'hotels-appartment-country-id',
                        ]
                    ]
                ); ?>
                <?=
                $form->field($model, 'city_id')->widget(\kartik\widgets\DepDrop::className(), [

                        'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                        'data' => $cityTo,
                        'options' => ['placeholder' => Yii::t('app', 'Begin Select Country')],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'depends' => ['lkorder-country_id'],
                            'url' => \yii\helpers\Url::to(['/lk/reservation/child-city']),
                            'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                        ]

                        /*'data' => null, //\yii\helpers\ArrayHelper::map(common\models\City::find()->active()->asArray()->all(), 'id', 'name'),
                        'options'=>[

                            'prompt' => Yii::t('app', 'Select'),
                            'options' =>[$countryId => ['selected'=>true]],
                            //'id'=>'hotels-appartment-country-id',
                        ]*/
                    ]

                ); ?>

                <?=
                $form->field($model, 'stars_id')->widget(\kartik\widgets\Select2::className(), [
                        'data' => \yii\helpers\ArrayHelper::map(common\models\HotelsStars::find()->asArray()->all(), 'id', 'name'),
                        'options' => [
                            'prompt' => Yii::t('app', 'Select'),
                            'options' => [$starsId => ['selected' => true]],
                            //'id'=>'hotels-appartment-country-id',
                        ]
                    ]
                );
                ?>

                <?=
                $form->field($model, 'hotels_info_id')->widget(\kartik\widgets\DepDrop::className(), [
                        'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                        'data' => $hotelsInfoData,
                        'options' => ['placeholder' => Yii::t('app', 'Begin Select Country')],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'depends' => ['lkorder-city_id', 'lkorder-stars_id'],
                            'url' => \yii\helpers\Url::to(['/lk/reservation/child-hotels']),
                            'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                        ]
                    ]
                );
                ?>
            </div>
            <?php

            ?>
            <div class="panel-footer">
                <div id="lkorder-hotels-info-details">

                </div>
            </div>


        </div>
    </div>

    <div class="appartment-info">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Как проживаем?</h3>
            </div>
            <div class="panel-body">

                <?= $form->field($model, 'hotels_type_of_food_id')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsTypeOfFood::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Type of food')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <?=
                $form->field($model, 'hotels_appartment_id')->widget(\kartik\widgets\DepDrop::className(), [
                        'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                        'data' => null,
                        'options' => ['placeholder' => Yii::t('app', 'Choose Hotels appartment')],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'depends' => ['lkorder-hotels_info_id', 'lkorder-hotels_type_of_food_id'],
                            'url' => \yii\helpers\Url::to(['/lk/reservation/child-appartment']),
                            'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                        ]
                    ]
                );
                ?>

            </div>
        </div>

    </div>

    <div class="city-out">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Откуда выдвигаемся?</h3>
            </div>
            <div class="panel-body">

                <?php /*echo $form->field($model, 'trans_info_id')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\TourTypeTransport::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Tour type transport')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);*/ ?>

                <?=
                $form->field($model, 'country_out_id')->widget(\kartik\widgets\Select2::className(), [
                        'data' => \yii\helpers\ArrayHelper::map(common\models\Country::find()->asArray()->all(), 'id', 'name'),
                        'options' => [

                            'prompt' => Yii::t('app', 'Select'),
                            'options' => [$countryId => ['selected' => true]],
                            //'id'=>'hotels-appartment-country-id',
                        ]
                    ]

                ); ?>
                <?=
                $form->field($model, 'city_out_id')->widget(\kartik\widgets\DepDrop::className(), [

                        'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                        'data' => null,
                        'options' => ['placeholder' => Yii::t('app', 'Begin Select Country')],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'depends' => ['lkorder-country_out_id'],
                            'url' => \yii\helpers\Url::to(['/lk/reservation/child-city']),
                            'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                        ]
                    ]

                ); ?>

            </div>
        </div>
    </div>

    <div class="transport-info">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">На чем добираемся ...</h3>
            </div>

            <div class="panel-body">

                <?php /*echo $form->field($model, 'trans_info_id')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\TourTypeTransport::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Tour type transport')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);*/ ?>

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">... к месту отдыха?</h3>
                    </div>

                    <div class="panel-body">

                        <?=
                        $form->field($model, 'trans_info_id')->widget(\kartik\widgets\DepDrop::className(), [

                                'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                                'data' => null,
                                'options' => ['placeholder' => Yii::t('app', 'Begin Select Appartment')],
                                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                'pluginOptions' => [
                                    'depends' => ['lkorder-hotels_appartment_id'],
                                    'url' => \yii\helpers\Url::to(['/lk/reservation/child-transport']),
                                    'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                                ]

                                /*'data' => null, //\yii\helpers\ArrayHelper::map(common\models\City::find()->active()->asArray()->all(), 'id', 'name'),
                                'options'=>[

                                    'prompt' => Yii::t('app', 'Select'),
                                    'options' =>[$countryId => ['selected'=>true]],
                                    //'id'=>'hotels-appartment-country-id',
                                ]*/
                            ]

                        ); ?>

                        <?=
                        $form->field($model, 'trans_route')->widget(\kartik\widgets\DepDrop::className(), [

                                'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                                'data' => null,
                                'options' => ['placeholder' => Yii::t('app', 'Begin Select Transport')],
                                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                'pluginOptions' => [
                                    'depends' => ['lkorder-trans_info_id', 'lkorder-hotels_appartment_id',
                                        'lkorder-hotels_info_id', 'lkorder-city_id', 'lkorder-date_range-start',
                                        'lkorder-city_out_id'],
                                    'url' => \yii\helpers\Url::to(['/lk/reservation/get-transport']),
                                    'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                                ]
                            ]

                        ); ?>
                    </div>
                    <div class="panel-footer">
                        <div id="lkorder-trans-info-details">

                        </div>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">... от места отдыха?</h3>
                    </div>

                    <div class="panel-body">

                        <?=
                        $form->field($model, 'trans_info_id_reverse')->widget(\kartik\widgets\DepDrop::className(), [

                                'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                                'data' => null,
                                'options' => ['placeholder' => Yii::t('app', 'Begin Select Appartment')],
                                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                'pluginOptions' => [
                                    'depends' => ['lkorder-hotels_appartment_id'],
                                    'url' => \yii\helpers\Url::to(['/lk/reservation/child-transport']),
                                    'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                                ]

                                /*'data' => null, //\yii\helpers\ArrayHelper::map(common\models\City::find()->active()->asArray()->all(), 'id', 'name'),
                                'options'=>[

                                    'prompt' => Yii::t('app', 'Select'),
                                    'options' =>[$countryId => ['selected'=>true]],
                                    //'id'=>'hotels-appartment-country-id',
                                ]*/
                            ]

                        ); ?>

                        <?=
                        $form->field($model, 'trans_route_reverse')->widget(\kartik\widgets\DepDrop::className(), [

                                'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                                'data' => null,
                                'options' => ['placeholder' => Yii::t('app', 'Begin Select Transport')],
                                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                'pluginOptions' => [
                                    'depends' => ['lkorder-trans_info_id', 'lkorder-hotels_appartment_id',
                                        'lkorder-hotels_info_id', 'lkorder-city_id', 'lkorder-date_range-end',
                                        'lkorder-city_out_id'],
                                    'url' => \yii\helpers\Url::to(['/lk/reservation/get-transport-reverse']),
                                    'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                                ]
                            ]

                        ); ?>
                    </div>
                    <div class="panel-footer">
                        <div id="lkorder-trans-info-details-reverse">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?= $form->field($model, 'userinfo_id', ['template' => '{input}'])->textInput([
    'value' => Yii::$app->user->id,
    'readonly' => true,
    'style' => 'display:none'
]); ?>


<?php
//TODO Продумать логику проверки: если сaтатус заказа не новый, тогда выводить заголовок "Полная стоимость"
(($model->sal_order_status_id == 1) or ($model->isNewRecord)) ? $price_label = Yii::t('app', 'Price Residence') : $price_label = Yii::t('app', 'Full Price');
?>
<?php /*echo  $form->field($model, 'full_price')->textInput(['placeholder' => $price_label])->label($price_label)*/ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Next'), ['class' => 'btn btn-primary pull-right', 'value' => '1', 'name' => '_toperson']) ?>
    </div>
    <div class="master-tour">

    </div>
<?php ActiveForm::end(); ?>