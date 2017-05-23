<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Person */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'BusReservationHasPerson',
        'relID' => 'bus-reservation-has-person',
        'value' => \yii\helpers\Json::encode($model->busReservationHasPeople),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'SalOrderHasPerson',
        'relID' => 'sal-order-has-person',
        'value' => \yii\helpers\Json::encode($model->salOrderHasPeople),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Firstname')]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Lastname')]) ?>

    <?= $form->field($model, 'secondname')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Secondname')]) ?>

    <?= $form->field($model, 'date_new')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date New'),
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'passport_ser')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Passport Ser')]) ?>

    <?= $form->field($model, 'passport_num')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Passport Num')]) ?>

    <?= $form->field($model, 'birthday')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Birthday'),
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'contacts')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'child')->textInput(['placeholder' => Yii::t('app', 'Child')]) ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'gender_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Gender::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Gender')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'BusReservationHasPerson')),
            'content' => $this->render('_formBusReservationHasPerson', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->busReservationHasPeople),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'SalOrderHasPerson')),
            'content' => $this->render('_formSalOrderHasPerson', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->salOrderHasPeople),
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
