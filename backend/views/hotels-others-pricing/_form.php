<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsOthersPricing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotels-others-pricing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hotels_info_id')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'type_price')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'hotels_others_pricing_type_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
