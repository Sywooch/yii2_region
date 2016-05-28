<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusReservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bus-reservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bus_info_id')->textInput() ?>

    <?= $form->field($model, 'bus_way_id')->textInput() ?>

    <?= $form->field($model, 'number_seat')->textInput() ?>

    <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
