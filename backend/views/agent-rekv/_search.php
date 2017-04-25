<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchAgentRekv */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-agent-rekv-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'fullname')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'inn')->textInput(['placeholder' => 'Inn']) ?>

    <?php /* echo $form->field($model, 'kpp')->textInput(['placeholder' => 'Kpp']) */ ?>

    <?php /* echo $form->field($model, 'ogrn')->textInput(['placeholder' => 'Ogrn']) */ ?>

    <?php /* echo $form->field($model, 'bik')->textInput(['placeholder' => 'Bik']) */ ?>

    <?php /* echo $form->field($model, 'bankname')->textInput(['maxlength' => true, 'placeholder' => 'Bankname']) */ ?>

    <?php /* echo $form->field($model, 'rs')->textInput(['maxlength' => true, 'placeholder' => 'Rs']) */ ?>

    <?php /* echo $form->field($model, 'ks')->textInput(['maxlength' => true, 'placeholder' => 'Ks']) */ ?>

    <?php /* echo $form->field($model, 'direktor_fio')->textInput(['maxlength' => true, 'placeholder' => 'Direktor Fio']) */ ?>

    <?php /* echo $form->field($model, 'direktor_dolgnost')->textInput(['maxlength' => true, 'placeholder' => 'Direktor Dolgnost']) */ ?>

    <?php /* echo $form->field($model, 'glbuh_fio')->textInput(['maxlength' => true, 'placeholder' => 'Glbuh Fio']) */ ?>

    <?php /* echo $form->field($model, 'glbuh_dolgnost')->textInput(['maxlength' => true, 'placeholder' => 'Glbuh Dolgnost']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <?php /* echo $form->field($model, 'active')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) */ ?>

    <?php /* echo $form->field($model, 'phone2')->textarea(['rows' => 6]) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
