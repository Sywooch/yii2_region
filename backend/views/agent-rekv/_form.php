<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AgentRekv */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="agent-rekv-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Name')]) ?>

    <?= $form->field($model, 'fullname')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'inn')->textInput(['placeholder' => Yii::t('app', 'Inn')]) ?>

    <?= $form->field($model, 'kpp')->textInput(['placeholder' => Yii::t('app', 'Kpp')]) ?>

    <?= $form->field($model, 'ogrn')->textInput(['placeholder' => Yii::t('app', 'Ogrn')]) ?>

    <?= $form->field($model, 'bik')->textInput(['placeholder' => Yii::t('app', 'Bik')]) ?>

    <?= $form->field($model, 'bankname')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Bankname')]) ?>

    <?= $form->field($model, 'rs')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Rs')]) ?>

    <?= $form->field($model, 'ks')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Ks')]) ?>

    <?= $form->field($model, 'direktor_fio')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Direktor Fio')]) ?>

    <?= $form->field($model, 'direktor_dolgnost')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Direktor Dolgnost')]) ?>

    <?= $form->field($model, 'glbuh_fio')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Glbuh Fio')]) ?>

    <?= $form->field($model, 'glbuh_dolgnost')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Glbuh Dolgnost')]) ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Phone')]) ?>

    <?= $form->field($model, 'phone2')->textarea(['rows' => 6]) ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
