<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransRoute */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TransRouteHasTransStation',
        'relID' => 'trans-route-has-trans-station',
        'value' => \yii\helpers\Json::encode($model->transRouteHasTransStations),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="trans-route-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date Begin'),
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date End'),
                'autoclose' => true,
            ]
        ],
    ]); ?>



    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
    $forms = [
        /*[
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TransInfo')),
            'content' => $this->render('_formTransInfo', [
                'form' => $form,
                'TransInfo' => is_null($model->transInfos) ? new common\models\TransInfo() : $model->transInfos,
            ]),
        ],*/
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TransRouteHasTransStation')),
            'content' => $this->render('_formTransRouteHasTransStation', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->transRouteHasTransStations),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
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
