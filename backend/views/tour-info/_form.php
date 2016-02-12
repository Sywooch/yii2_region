<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TourInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'days')->textInput() ?>

    <?= $form->field($model, 'tour_type_id')->textInput() ?>

    <?= $form->field($model, 'toury_type_transport_id')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
