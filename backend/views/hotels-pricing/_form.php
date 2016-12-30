<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPricing */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'HotelsPayPeriod',
        'relID' => 'hotels-pay-period',
        'value' => \yii\helpers\Json::encode($model->hotelsPayPeriods),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

$hotelsInfoData = null;
$countryId = 0;
$hotelsAppartmentData = null;
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

<div class="hotels-pricing-form">

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
                'depends' => ['hotelspricing-country'],
                'url' => \yii\helpers\Url::to(['/hotels-pricing/child-hotels-info']),
                'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
            ]
        ]


    );
    ?>



    <?= $form->field($model, 'hotels_appartment_id')->widget(\kartik\widgets\DepDrop::classname(), [
        'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
        'data' => $hotelsAppartmentData,
        //'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsAppartment::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Hotels appartment')],
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['hotelspricing-hotels_info_id'],
            'url' => \yii\helpers\Url::to(['/hotels-pricing/child-hotels-appartment']),
            'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
        ]
    ]); ?>



    <?= $form->field($model, 'hotels_type_of_food_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsTypeOfFood::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Hotels type of food')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'HotelsPayPeriod')),
            'content' => $this->render('_formHotelsPayPeriod', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->hotelsPayPeriods),
            ]),
        ],
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
