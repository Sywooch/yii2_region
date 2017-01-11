<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\SearchHotelsInfo $model
 * @var yii\widgets\ActiveForm $form
 */
$cityOut = null;
$cityTo = null;
if (isset($model->countryOut) && $model->countryOut != "") {
    $cityOut = \yii\helpers\ArrayHelper::map(common\models\City::find()
        ->andWhere(['country_id' => $model->countryOut])
        ->asArray()->all(), 'id', 'name');
}
if (isset($model->countryTo) && $model->countryTo != "") {
    $cityTo = \yii\helpers\ArrayHelper::map(common\models\City::find()
        ->andWhere(['country_id' => $model->countryTo])
        ->asArray()->all(), 'id', 'name');
}

if ((isset($model->date_begin) && $model->date_begin == "") || (!isset($model->date_begin))) {
    $model->date_begin = date('d.m.Y');
}
if (!isset($model->date_end) or $model->date_end == "") {
    $model->date_end = date('d.m.Y');
}

?>

<div class="hotels-info-search">

        <?php $form = ActiveForm::begin([
            'action' => ['/tour'],
            'method' => 'GET',
        ]); ?>

        <div class="col-md-12">
            <?=
            $form->field($model, 'countryOut')->widget(\kartik\widgets\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(common\models\Country::find()->asArray()->all(), 'id', 'name'),
                    'options' => [
                        'prompt' => Yii::t('app', 'Select'),
                        //'options' => [$countryId => ['selected' => true]],
                        //'id'=>'hotels-appartment-country-id',
                    ]
                ]
            ); ?>
        </div>

        <div class="col-md-12">
            <?=
            $form->field($model, 'cityOut')->widget(\kartik\widgets\DepDrop::className(), [

                    'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                    'data' => $cityOut,
                    'options' => ['placeholder' => Yii::t('app', 'Begin Select Country')],
                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                    'pluginOptions' => [
                        'depends' => ['searchadvancedfilter-countryout'],
                        'url' => \yii\helpers\Url::to(['/tour/child-city-out']),
                        'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                    ]
                ]

            ); ?>
        </div>
        <div class="col-md-12">
            <?=
            $form->field($model, 'countryTo')->widget(\kartik\widgets\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(common\models\Country::find()->orderBy('name')->all(), 'id', 'name'),
                    'options' => [
                        'prompt' => Yii::t('app', 'Select'),
                    ]
                ]
            ); ?>
        </div>
        <div class="col-md-12">
            <?=
            $form->field($model, 'cityTo')->widget(\kartik\widgets\DepDrop::className(), [
                    'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                    'data' => $cityTo,
                    'options' => ['placeholder' => Yii::t('app', 'Begin Select Country')],
                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                    'pluginOptions' => [
                        'depends' => ['searchadvancedfilter-countryto'],
                        'url' => \yii\helpers\Url::to(['/tour/child-city-to']),
                        'loadingText' => Yii::t('app', 'Please wait, loading data ...'),
                    ]
                ]
            ); ?>
        </div>
        <div class="col-md-12">
            <?=
            $form->field($model, 'tourTypes')->widget(\kartik\widgets\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(common\models\TourType::find()->active()->orderBy('name')->all(), 'id', 'name'),
                    'options' => [
                        'prompt' => Yii::t('app', 'Select'),
                    ]
                ]
            ); ?>
        </div>
        <div class="col-md-12">
            <?=
            $form->field($model, 'stars')->widget(\kartik\widgets\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(common\models\HotelsStars::find()->all(), 'id', 'name'),
                    'options' => [
                        'prompt' => Yii::t('app', 'Select'),
                    ]
                ]
            ); ?>
        </div>
        <div class="col-md-12">
            <?=
            $form->field($model, 'typeOfFood')->widget(\kartik\widgets\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(common\models\HotelsTypeOfFood::find()->all(), 'id', 'name'),
                    'options' => [
                        'prompt' => Yii::t('app', 'Select'),
                    ]
                ]
            ); ?>
        </div>
        <div class="col-md-12">
            <?=
            $form->field($model, 'appartmentType')->widget(\kartik\widgets\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(common\models\HotelsAppartmentItem::find()->active()->all(), 'id', 'name'),
                    'options' => [
                        'prompt' => Yii::t('app', 'Select'),
                    ]
                ]
            ); ?>
        </div>

        <div class="col-md-12">
            <?=
            \kartik\field\FieldRange::widget([
                'form' => $form,
                'model' => $model,
                'label' => Yii::t('app', 'Enter range price'),
                'attribute1' => 'priceMin',
                'attribute2' => 'priceMax',
                'separator' => ' - ',
                'options1' => [
                    'type' => 'number   '
                ],
                //'type' => \kartik\field\FieldRange::INPUT_WIDGET,
                //'widgetClass' => \kartik\widgets\InputWidget::className(),

            ]);
            ?>

        </div>
        <div class="col-md-12">

            <?= $form->field($model, 'days')->widget(\kartik\widgets\TouchSpin::classname(), [
                //'readonly' => true,
                'options' => ['placeholder' => ''],
            ]); ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'touristCount')->widget(\kartik\widgets\TouchSpin::classname(), [
                'readonly' => true,
                'options' => ['placeholder' => ''],
            ]); ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'childCount')->widget(\kartik\widgets\TouchSpin::classname(), [
                'readonly' => true,
                'options' => ['placeholder' => ''],
            ]); ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'date_begin')->widget(\kartik\widgets\DatePicker::className(), [
                'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
            ]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'date_end')->widget(\kartik\widgets\DatePicker::className(), [
                'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
            ]) ?>
        </div>

        <?php // echo $form->field($model, 'links_maps') ?>


        <div class="row">

            <div class="text-center form-group">
                <?= Html::submitButton(Yii::t('app', 'Search tour'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
            </div>

        </div>

        <?php ActiveForm::end(); ?>

</div>
