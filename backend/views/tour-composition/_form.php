<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TourComposition */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tour-composition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Name')]) ?>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Элементы, входящие в состав тура:</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'hotel')->checkbox() ?>

                <?= $form->field($model, 'transport')->checkbox() ?>

                <?= $form->field($model, 'food')->checkbox() ?>

                <?= $form->field($model, 'transfer')->checkbox() ?>

                <?= $form->field($model, 'insure')->checkbox() ?>

                <?= $form->field($model, 'visa')->checkbox() ?>

                <?= $form->field($model, 'excursion')->checkbox() ?>
            </div>

        </div>
    </div>


    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>


    <div class="form-group">
        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if (Yii::$app->controller->action->id != 'create'): ?>
            <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
