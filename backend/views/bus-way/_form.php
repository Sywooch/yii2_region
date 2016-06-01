<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusWay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bus-way-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bus_info_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(common\models\BusInfo::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]
    ) ?>

    <?= $form->field($model, 'date_create')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'ended')->checkbox() ?>

    <?= $form->field($model, 'bus_path_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(common\models\BusRoute::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]
    ) ?>

    <?= $form->field($model, 'path_time')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
