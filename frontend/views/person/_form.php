<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secondname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_new')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'langauge' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
    ]) ?>

    <?= $form->field($model, 'date_edit')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'langauge' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
    ]) ?>

    <?= $form->field($model, 'passport_ser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacts')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other')->textarea(['rows' => 6]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
