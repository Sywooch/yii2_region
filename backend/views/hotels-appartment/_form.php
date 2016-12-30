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
            'options' => ['placeholder' => Yii::t('app', 'Begin Select Country')],
            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'pluginOptions' => [
                'depends' => ['hotelsappartment-country'],
                'url' => \yii\helpers\Url::to(['/hotels-appartment/child-hotels-info']),
                'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
            ]
        ]


    );
    ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['placeholder' => 'Price']) ?>

    <?= $form->field($model, 'hotels_appartment_item_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsAppartmentItem::find()->active()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Hotels appartment item')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'count_rooms')->textInput(['placeholder' => 'Count Rooms']) ?>

    <?= $form->field($model, 'count_beds')->textInput(['placeholder' => 'Count Beds']) ?>

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
