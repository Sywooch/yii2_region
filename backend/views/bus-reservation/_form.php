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

    <?= $form->field($model, 'bus_info_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(common\models\BusInfo::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]
    ); ?>

    <?= $form->field($model, 'bus_way_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(common\models\BusWay::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]
    ); ?>

    <?= $form->field($model, 'number_seat')->textInput() ?>

    <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
