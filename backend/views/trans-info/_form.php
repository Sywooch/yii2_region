<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransInfo */
/* @var $form yii\widgets\ActiveForm */

/*\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'SalBasket', 
        'relID' => 'sal-basket', 
        'value' => \yii\helpers\Json::encode($model->salBaskets),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);*/
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TransPrice',
        'relID' => 'trans-price',
        'value' => \yii\helpers\Json::encode($model->transPrices),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TransSeats',
        'relID' => 'trans-seats',
        'value' => \yii\helpers\Json::encode($model->transSeats),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="trans-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'trans_type_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\TransType::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Trans type')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'trans_route_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\TransRoute::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Trans route')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'seats')->textInput(['placeholder' => 'Seats']) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
    $forms = [
        /*[
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'SalBasket')),
            'content' => $this->render('_formSalBasket', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->salBaskets),
            ]),
        ],*/
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TransSeats')),
            'content' => $this->render('_formTransSeats', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->transSeats),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TransPrice')),
            'content' => $this->render('_formTransPrice', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->transPrices),
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
