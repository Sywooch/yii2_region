<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\SearchHotelsInfo $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="hotels-info-search">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin([
            'action' => ['/tour'],
            'method' => 'GET',
        ]); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'tourTypes')->dropDownList(
                    \yii\helpers\ArrayHelper::map(common\models\TourType::find()->orderBy('name')->all(), 'id', 'name'),
                    ['prompt' => Yii::t('app', 'Select')]
                ); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'countryTo')->dropDownList(
                    \yii\helpers\ArrayHelper::map(common\models\Country::find()->orderBy('name')->all(), 'id', 'name'),
                    ['prompt' => Yii::t('app', 'Select')]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'cityTo')->dropDownList(
                    \yii\helpers\ArrayHelper::map(common\models\City::find()->active()->andFilterWhere(['active' => 1])
                        ->orderBy('name')->all(), 'id', 'name'),
                    ['prompt' => Yii::t('app', 'Select')]
                ); ?>
            </div>
            <div class="col-md-6">
                <?= // generated by schmunk42\giiant\generators\crud\providers\RelationProvider::activeField
                $form->field($model, 'stars')->dropDownList(
                    \yii\helpers\ArrayHelper::map(common\models\HotelsStars::find()->all(), 'id', 'name'),
                    ['prompt' => Yii::t('app', 'Select')]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'priceMin') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'priceMax') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'touristCount') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'childCount') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'date_begin')->widget(\kartik\widgets\DatePicker::className(), [
                    'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'date_end')->widget(\kartik\widgets\DatePicker::className(), [
                    'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
                ]) ?>
            </div>
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
</div>
