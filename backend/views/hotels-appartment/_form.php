<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsAppartment */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'HotelsAppartmentHasHotelsTypeOfFood',
        'relID' => 'hotels-appartment-has-hotels-type-of-food',
        'value' => \yii\helpers\Json::encode($model->hotelsAppartmentHasHotelsTypeOfFoods),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'HotelsPricing',
        'relID' => 'hotels-pricing',
        'value' => \yii\helpers\Json::encode($model->hotelsPricings),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

//Создаем автоназвание тура (отключаем в случае ручного редактирования пользователем)
//Отключаем авторедактирование при изменении записи
$sStop = 'stop = false,';
if ((!$model->isNewRecord && $model->name != "") ){
    $sStop = 'stop = true,';
}
$jsVar = '
    var $carsList = $("#hotelsappartment-name"),
        ' .$sStop . '
        items = [];
';

$this->registerJs($jsVar . '    
        $(".ha-name").change(function(){
        if (stop == false){
            editValue(".ha-name","#hotelsappartment-count_beds");
            }
        });
        $("#hotelsappartment-count_beds").change(function(){
        if (stop == false){
            editValue(".ha-name","#hotelsappartment-count_beds");
            }
        });
    
    //Включаем авторедактирование, если запись очистили
    $carsList.change(function(){
    t = $(this).val();
        if (t.length == 0){
            stop = false
        }
        else{
            stop = true;
        }
    });
    
    function editValue(hclass,hid){
        $(hclass).each(function(){
            if ($(this).val() != null){
                items[$(hclass).index(this)] = $(this).find("option:selected").text();
            }
        });
            value = items.join(", ");
            if ($(hid).val()){
                value += ", мест:" + $(hid).val();
            }
            $($carsList).val("Номер: " + value);
    }

');



$hotelsInfoData = null;
$countryId = 0;
if ($model->getCountry()) {
    $countryId = $model->getCountry()->id;
    $hotelsInfoData =
        \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::find()->active()
            ->andWhere(['country' => $countryId])
            ->orderBy('id')
            ->asArray()
            ->all(), 'id', 'name');
}


?>

<div class="hotels-appartment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?=
    $form->field($model, 'country')->widget(\kartik\widgets\Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map(common\models\Country::find()->asArray()->all(), 'id', 'name'),
            'options' => [

                'prompt' => Yii::t('app', 'Select'),
                'options' => [$countryId => ['selected' => true]],
                //'id'=>'hotels-appartment-country-id',
            ]
        ]

    ); ?>

    <?=
    $form->field($model, 'hotels_info_id')->widget(\kartik\widgets\DepDrop::className(), [
            'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
            'data' => $hotelsInfoData,
            'options' => [
                'placeholder' => Yii::t('app', 'Begin Select Country'),
                'class' => 'ha-name',
            ],
            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'pluginOptions' => [
                'depends' => ['hotelsappartment-country'],

                'url' => \yii\helpers\Url::to(['/hotels-appartment/child-hotels-info']),
                'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
            ]
        ]
    );
    ?>

    <?= $form->field($model, 'hotels_appartment_item_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsAppartmentItem::find()->active()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => [
            'placeholder' => Yii::t('app', 'Choose Hotels appartment item'),
            'class' => 'ha-name',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Название (формируется автоматически)']) ?>

    <?= $form->field($model, 'price')->textInput(['placeholder' => 'Базовая цена за комнату (выбирается, если не заполнять календарь цен)']) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'count_rooms')->textInput(['placeholder' => 'Общее количество комнат']) ?>

    <?= $form->field($model, 'count_beds')->textInput(['placeholder' => 'Количество мест(в одной комнате)']) ?>

    <?= $form->field($model, 'imageFiles[]')->widget(\kartik\file\FileInput::className(), [
        'language' => 'ru',
        'options' => ['multiple' => true, 'accept' => 'image/*',],
        'pluginOptions' => [
            'showRemove' => 'true',
            'previewFileType' => 'any',
            'allowedExtensions' => ['jpg', 'gif', 'png'],
            'showUpload' => false,
            'maxFileCount' => 12,
            //'uploadUrl' => \yii\helpers\Url::to(['uploads'])
        ],

    ]); ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'HotelsAppartmentHasHotelsTypeOfFood')),
            'content' => $this->render('_formHotelsAppartmentHasHotelsTypeOfFood', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->hotelsAppartmentHasHotelsTypeOfFoods),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'HotelsPricing')),
            'content' => $this->render('_formHotelsPricing', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->hotelsPricings),
            ]),
        ],
        /*[
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'SalOrder')),
            'content' => $this->render('_formSalOrder', [
                'form' => $form,
                'SalOrder' => is_null($model->salOrders) ? new common\models\SalOrder() : $model->salOrders,
            ]),
        ],*/
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
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
