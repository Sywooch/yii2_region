<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Discount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discount-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?= $form->field($model, 'type_price')->checkbox() ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'hotels_info_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::findAll(['active'=>1]),'id','name'),
        ['prompt' => Yii::t('app', 'Select'),]
    ) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
