<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPricing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotels-pricing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hotels_appartment_hotels_info_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(common\models\HotelsInfo::findAll(['active'=>1]), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]
    ) ?>
    
    <?= $form->field($model, 'hotels_appartment_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(common\models\Country::find(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]
    ) ?>

    <?= $form->field($model, 'hotels_others_pricing_id')->checkboxList(
        \yii\helpers\ArrayHelper::map(common\models\HotelsOthersPricing::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]
    ) ?>

    <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'full_price')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'hotels_type_of_food_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(common\models\HotelsTypeOfFood::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]
    ) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
