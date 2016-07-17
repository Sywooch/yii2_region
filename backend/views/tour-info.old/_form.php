<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\TourInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::className(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::className(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'days')->textInput() ?>

    <?php
    $rel_names = ArrayHelper::map(\common\models\TourType::find()->all(),'id','name');
    echo $form->field($model, 'tour_type_id')->dropDownList($rel_names,
        ['prompt' => 'Выберите Тип тура'])->label('Тип тура') ?>

    <?php
    $rel_names = ArrayHelper::map(\common\models\TourTypeTransport::find()->all(),'id','name');
    echo $form->field($model, 'toury_type_transport_id')->dropDownList($rel_names,
        ['prompt' => 'Выберите Тип транспорта'])->label('Тип транспорта') ?>

    <?= $form->field($model, 'active')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
