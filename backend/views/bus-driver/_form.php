<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusDriver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bus-driver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FIO')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'number_license')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'first')->textInput() ?>

    <?= $form->field($model, 'bus_info_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
