<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransRoute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-route-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_add')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'date_edit')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'begin_point')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'end_point')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
